<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
  <link rel="stylesheet" href="css/main.css" />
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
    <header>
            <!--Navigation bar-->
            <div id="nav-placeholder">

            </div>

            <script>
            $(function(){
            $("#nav-placeholder").load("nav.html");
            });
            </script>
            <!--end of Navigation bar-->
    </header>
    <script
     src="https://www.paypal.com/sdk/js?client-id=Aa1yazhfix0fBSu1O9XW71YjK9xDgow8wkuz1XaPVI9OxKnxhrk4J8wsI5rA24z7VVSviEFf7WvzkR1q&currency=EUR"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>

    <div id="paypal-button-container"></div>

    <script>
    //paypal.Buttons().render('#paypal-button-container');
  // This function displays Smart Payment Buttons on your web page.
    </script>

<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '0.01'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
        // Call your server to save the transaction
        return fetch('getOrder.php', {
          method: 'post',
          headers: {
            'content-type': 'application/json'
          },
          body: JSON.stringify({
            orderID: data.orderID
          })
        });
      });
    }
  }).render('#paypal-button-container');
</script>
        

</body>