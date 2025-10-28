function signin() {
  global $twig;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    try {
      $session = login($email, $password);
      $_SESSION['user'] = $session['user'];
      $_SESSION['expiresAt'] = $session['expiresAt'];
      header('Location: /dashboard');
      exit;
    } catch (Exception $e) {
      echo $twig->render('signin.twig', ['error' => $e->getMessage()]);
    }
  } else {
    echo $twig->render('signin.twig');
  }
}

function signup() {
  global $twig;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
      $session = signup($_POST);
      $_SESSION['user'] = $session['user'];
      $_SESSION['expiresAt'] = $session['expiresAt'];
      header('Location: /dashboard');
      exit;
    } catch (Exception $e) {
      echo $twig->render('signup.twig', ['error' => $e->getMessage()]);
    }
  } else {
    echo $twig->render('signup.twig');
  }
}

function logout() {
  logout();
  session_destroy();
  header('Location: /auth/signin');
}
