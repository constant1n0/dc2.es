<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

var_dump($_POST);

// Configuración de reCAPTCHA
define('RECAPTCHA_SECRET_KEY', 'TU_SECRET_KEY_AQUI');
define('RECAPTCHA_VERIFY_URL', 'https://www.google.com/recaptcha/api/siteverify');

// Función para verificar reCAPTCHA
// Usar solo si cURL Está desabilitado
/*
function verifyRecaptcha(string $responseToken) : string  {
    $data = [
        'secret' => RECAPTCHA_SECRET_KEY,
        'response' => $responseToken,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];
    
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    
    $context = stream_context_create($options);
    $result = file_get_contents(RECAPTCHA_VERIFY_URL, false, $context);
    $response = json_decode($result);
    
    return $response;
}
*/


function verifyRecaptcha(string $responseToken) : object {
    // Crear objeto de respuesta estándar
    $result = (object) [
        'success' => false,
        'error' => '',
        'score' => 0.0,
        'data' => null
    ];
    
    // Verificar que el token no esté vacío
    if (empty(trim($responseToken))) {
        $result->error = 'Token reCAPTCHA vacío';
        error_log($result->error);
        return $result;
    }
    
    // Verificar la longitud mínima
    if (strlen($responseToken) < 10) {
        $result->error = 'Token reCAPTCHA demasiado corto';
        error_log($result->error);
        return $result;
    }
    
    $data = [
        'secret' => RECAPTCHA_SECRET_KEY,
        'response' => $responseToken,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];
    
    $ch = curl_init(RECAPTCHA_VERIFY_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Verificar error de cURL
    if ($error) {
        $result->error = 'Error de conexión: ' . $error;
        error_log($result->error);
        return $result;
    }
    
    // Verificar código HTTP
    if ($httpCode !== 200) {
        $result->error = 'Error HTTP: ' . $httpCode;
        error_log($result->error);
        return $result;
    }
    
    // Decodificar la respuesta JSON
    $googleResponse = json_decode($response);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        $result->error = 'Error decodificando JSON: ' . json_last_error_msg();
        error_log($result->error);
        return $result;
    }
    
    // Si llegamos aquí, la verificación fue técnica exitosa
    $result->data = $googleResponse;
    
    // Verificar la respuesta de Google
    if ($googleResponse->success === true) {
        $result->success = true;
        $result->score = $googleResponse->score ?? 0.0;
        $result->error = '';
    } else {
        $result->success = false;
        $result->error = 'Verificación reCAPTCHA fallida';
        // Agregar códigos de error si existen
        if (!empty($googleResponse->{'error-codes'})) {
            $result->error .= ': ' . implode(', ', $googleResponse->{'error-codes'});
        }
        error_log($result->error);
    }
    
    return $result;
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar reCAPTCHA
    $recaptchaResponse = $_POST['recaptcha_response'] ?? '';
    $verification = verifyRecaptcha($recaptchaResponse);
    
    if ($verification->success && $verification->score >= 0.5) {
        // reCAPTCHA válido, procesar el formulario
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $asunto = filter_var($_POST['asunto'], FILTER_SANITIZE_STRING);
        $mensaje = filter_var($_POST['mensaje'], FILTER_SANITIZE_STRING);
        $ipClient = $_POST['ipClient'];
        
        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Email no válido');
        }
        
        // Aquí puedes procesar el formulario (enviar email, guardar en BD, etc.)
        $destinatario = "info@dc2.es";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        $cuerpoMensaje = "Nombre: $nombre\n";
        $cuerpoMensaje .= "Email: $email\n";
        $cuerpoMensaje .= "Asunto: $asunto\n";
        $cuerpoMensaje .= "Mensaje:\n$mensaje\n\n";
        $cuerpoMensaje .= "IP: $ipClient\n";
        $cuerpoMensaje .= "Fecha: " . date('Y-m-d H:i:s');
        
        if (mail($destinatario, $asunto, $cuerpoMensaje, $headers)) {
            // Redirigir a página de éxito
            header('Location: gracias.html');
            exit;
        } else {
            die('Error al enviar el mensaje');
        }
        
    } else {
        // reCAPTCHA inválido
        die('Error de verificación de reCAPTCHA. Por favor, intenta nuevamente.');
    }
} else {
    // Método no permitido
    header('HTTP/1.1 405 Method Not Allowed');
    exit;
}