<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=cyrillic" rel="stylesheet">
  <title></title>
  <style type="text/css">
    @media only screen and (max-width: 480px){
      #templateColumns{
        width:100% !important;
      }

      .templateColumnContainer{
        display:block !important;
        width:100% !important;
      }

      .columnImage{
        height:auto !important;
        max-width:480px !important;
        width:100% !important;
      }
    }
  </style>
</head>
<body style="margin:0; padding:0; color: #A3A3A3; font-family: 'Roboto', sans-serif; background-color:#041123">
<center>
  <br><br>
  <table style="margin:20px 0; padding:20px 0;" width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#041123" id="templateColumns">
    <tr>
      <td align="left" valign="top" width="50%" class="templateColumnContainer">
        <img src="https://leadrex.io/img/leadrex-logo.png" width="280" style="max-width:280px;" class="columnImage">
        <h1>Новый запрос на инвестирование в USD</h1>
        <p style="color: white;">Почта: {{ $mailData['email'] }}</p>
        <p>Имя: {{ $mailData['name'] }}</p>
        <p>Адрес: {{ $mailData['address'] }}</p>
        <p>Телефон: {{ $mailData['phone'] }}</p>
        <p>Источник доходов: {{ $mailData['sourceOfFunds'] }}</p>
        <p>Кошелёк ETH: {{ $mailData['wallet'] }}</p>
        <p>Размер инвестиции: {{ $mailData['amount']}} $</p>
      </td>
    </tr>
  </table>
  <br><br>
</center>
</body>
</html>

