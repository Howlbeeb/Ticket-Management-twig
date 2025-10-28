function index() {
  global $twig;
  echo $twig->render('dashboard.twig', ['session' => $_SESSION]);
}

function landingPage() {
  global $twig;
  echo $twig->render('landingPage.twig');
}

function settings() {
  global $twig;
  echo $twig->render('settings.twig', ['session' => $_SESSION]);
}
