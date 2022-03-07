<!DOCTYPE html>
<html>
<head>
        <title> WALLET </title>
</head>    
<body style="background-image: radial-gradient(circle, rgb(195, 235, 242) 40%, rgb(0, 180, 245) 180%);" >
<center>     
    <h1> <font face="Arial" size="5px"> MY WALLET </font> </h1>
    <body>
            <label> 
            <div>
             Saved Payment:
            <form action="card_info.php" method="POST"> 
            <button>Saved Payments</button>
            </form>
            </div>
            </label>
    </body>
    <br><br>
    <label> 
            <div>
                <font face="Arial" size="2px">    
            <a href="http://localhost:8080/PokeKart/forms/card_forms/add_card.php"> Add New Payment </a>
           </font> 
         </div>
    <br><br>
    <div>
        <a href="http://localhost:8080/PokeKart/forms/card_forms/cont.php" >
            <button>Use This Payment Method</button>
        </a>
    </div>
    </label>
</center>
</body>
</html>