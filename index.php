<?

// Example script that display's the user's info

require_once 'thingiverse.php';

$tv = new Thingiverse();
$tv->client_id = "cf5e980be32c6740501a";
$tv->client_secret = "d54cd492ec469876d642d8c919f57833";
$tv->redirect_uri = "http://test-app.dev:8888";

$tv->api_url = "http://api.thingiverse.dev:8888";
$tv->web_url = "http://thingiverse.dev:8888";

if (!isset($_GET['code'])) {
	error_log("redirecting to login");
	header("Location: " . $tv->makeLoginUrl());
	exit();
} else {
	error_log("getting token");
	$tv->oAuth($_GET['code']);

	if (!$tv->access_token) {
		header("Location: " . $tv->makeLoginUrl());
		exit();
	}
}

$tv->getUser();
print_r($tv->response_data);

?>