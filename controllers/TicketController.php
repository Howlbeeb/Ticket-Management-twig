function index() {
  global $twig;
  $tickets = getTickets();
  echo $twig->render('ticketPage.twig', ['tickets' => $tickets, 'session' => $_SESSION]);
}

function create() {
  createTicket($_POST);
  header('Location: /dashboard/tickets');
}

function edit($id) {
  updateTicket($id, $_POST);
  header('Location: /dashboard/tickets');
}

function delete($id) {
  deleteTicket($id);
  header('Location: /dashboard/tickets');
}
