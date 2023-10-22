<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FeedbackForU</title>
    <style>
      * {
        margin: 0;
        padding: 0;
      }
      footer {
        background-color: #333;
        color: white;
        padding: 30px 0;
        text-align: center;
      }
      .div {
        display: flex;
        justify-content: space-between;
        max-width: 800px;
        width: 90%;
        margin: 0 auto;
      }
      .section {
        text-align: left;
        padding: 10px;
        display: flex;
        flex-direction: column;
        row-gap: 0.5rem;
      }
      .policy {
        text-decoration: none;
        color: #ededed;
        transition: color 0.3s;
      }
      .policy:hover {
        color: #00aaff;
        cursor: pointer;
      }
      h2 {
        font-size: 1.2em;
      }
      p {
        font-size: 0.9em;
      }
    </style>
  </head>
  <body>
    <footer>
      <div class="div">
        <section class="section">
          <h2>Contatti</h2>
          <p>+39 654 562 2252</p>
          <p>help@feedback4u.it</p>
        </section>
        <section class="section">
          <h2>Condizioni d'utilizzo</h2>
          <p class="policy">Privacy Policy</p>
          <p class="policy">Cookie Policy</p>
        </section>
      </div>
      <p>&copy; 2023 FeedbackForU</p>
    </footer>
  </body>
</html>
