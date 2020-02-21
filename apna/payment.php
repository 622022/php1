<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
</head>

<body>
    <script
     src="https://www.paypal.com/sdk/js?client-id=Aa1yazhfix0fBSu1O9XW71YjK9xDgow8wkuz1XaPVI9OxKnxhrk4J8wsI5rA24z7VVSviEFf7WvzkR1q"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
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
            value: '60.00'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name);
        // Call your server to save the transaction
        return fetch('/paypal-transaction-complete', {
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