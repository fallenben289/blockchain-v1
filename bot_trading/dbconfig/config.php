<!-- "api_key": "dtrcbj9sq4scc",
    "api_secret": "8tNrxafXusOmUSQmYHNjONUqefBRzXInnEHTuNiqZA0" -->

    <?php
// Luno API credentials


// Set the currency to Bitcoin (BTC)


// Only define the constant if it hasn't been defined already
if (!defined('LUNO_API_KEY')) {
    define('LUNO_API_KEY', 'dtrcbj9sq4scc');
}

if (!defined('LUNO_API_SECRET')) {
    define('LUNO_API_SECRET', '8tNrxafXusOmUSQmYHNjONUqefBRzXInnEHTuNiqZA0');

}

if (!defined('LUNO_API_URL')) {
    define('LUNO_API_URL', 'https://api.luno.com/api/1/');
}

if (!defined('CURRENCY')) {
    define('CURRENCY', 'BTC');
}

?>
