<?php
$subdomain = 'windows84'; //Поддомен нужного аккаунта
$link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

/** Соберем данные для запроса */
$data = [
    'client_id' => '010a4f28-d050-4fab-915c-78526ec18f33',
    'client_secret' => '3V1olhaVl3tpcJSPRRMM4V2YHQ8YhYUmKhAtwmC9PKtd4FqzsNY586uEsoMt8vr9',
    'grant_type' => 'authorization_code',
    'code' => 'def502008b96238df5d83655e59ef830e5960bce20fa167f7911ac59149cb26a98b36b34f9d7a3f97489de3fa90079b221ff90c3efe1540312baaba3491f1347e5b311351eefc555a60c715304f1767d6df51e67fdd8d209389427eb0bd717718327ab3a30ccdfbd9e21b8eeeeaf30604304f1b5fb99c50189e4c9661e1c7c2afbef343a0c641d647fe0a0c39616292ef38c29c65a561976488d8552d4dfdbf607e8267b78652659f6f8b4dd87cab447a35311829bb8570a43cd1ee846ecb41ff34ed35cb9f378daf88cc8238a5392b9fc6f5e7f2d3bb8e86c860f98c161d326ccb7f49ea109e941cc288b2128965223159ef476087a14c9c6f784535789ee2987654646f81660e56688bda20818854c0d5d132d036c5c071c80310647d9120253f0dbe1bebee55f7b09b05f9d04f8772f32f4be4c4ef22e11bbc6791c7a9e87bf33d8d9f22682f628e951508cf43f4b2806cf4db043c235b2ef851575090e6976f2281d84fcd5a817427f11040ef4de0ec277d8e68e67ff3031798227d1997ea27bd508a62a4fa24a155ac53b92dd0ca5ccb68ad08b2c1d3d3a5c7c0413596d80f695a4981de4b491cd78749ea09bc111783924a60ee9c0bfe106d4c6663febf2c6b315c0aec865790db6036b5191e5373ac3108a32c0025cecd390',
    'redirect_uri' => 'https://test.ru/',
];

/**
 * Нам необходимо инициировать запрос к серверу.
 * Воспользуемся библиотекой cURL (поставляется в составе PHP).
 * Вы также можете использовать и кроссплатформенную программу cURL, если вы не программируете на PHP.
 */
$curl = curl_init(); //Сохраняем дескриптор сеанса cURL
/** Устанавливаем необходимые опции для сеанса cURL  */
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
curl_setopt($curl,CURLOPT_URL, $link);
curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
curl_setopt($curl,CURLOPT_HEADER, false);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
$out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
/** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
$code = (int)$code;
$errors = [
    400 => 'Bad request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not found',
    500 => 'Internal server error',
    502 => 'Bad gateway',
    503 => 'Service unavailable',
];

try
{
    /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
    if ($code < 200 || $code > 204) {
        throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
    }
}
catch(Exception $e)
{
    die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
}

/**
 * Данные получаем в формате JSON, поэтому, для получения читаемых данных,
 * нам придётся перевести ответ в формат, понятный PHP
 */
$response = json_decode($out, true);

$access_token = $response['access_token']; //Access токен
$refresh_token = $response['refresh_token']; //Refresh токен
$token_type = $response['token_type']; //Тип токена
$expires_in = $response['expires_in']; //Через сколько действие токена истекает