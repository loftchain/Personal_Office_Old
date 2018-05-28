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
  <table style="margin:20px 0; padding:20px 0;" width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#a3a3a3" id="templateColumns">
    <tr>
      <td align="left" valign="top" width="50%" class="templateColumnContainer">
        <h1 style="color: black;">Новый запрос на инвестирование в USD</h1>
        <p style="color: black;">Почта: {{ $mailData['email'] }}</p>
        <p style="color: black;">Имя: {{ $mailData['name'] }}</p>
        <p style="color: black;">Адрес: {{ $mailData['address'] }}</p>
        <p style="color: black;">Телефон: {{ $mailData['phone'] }}</p>
        <p style="color: black;">Источник доходов: {{ $mailData['sourceOfFunds'] }}</p>
        <p style="color: black;">Кошелёк ETH: {{ $mailData['wallet'] }}</p>
        <p style="color: black;">Размер инвестиции: {{ $mailData['amount']}} $</p>
      </td>
    </tr>
  </table>
  <br><br>
</center>
</body>
</html>

