
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        
        <link href="https://fonts.googleapis.com/css2?
        family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
         <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-LZMmv1rwus7gupN2JiQ7fNkx6gXdIbYiOk/uFW81TdyT9zVRskQnKNmFlgm6U/ljPY4ySm4Ufhq3Ez8+1CewHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Landingpage css -->
        <link rel="stylesheet" href="./assets/css/landingpage.css">
        <!-- Loginform css -->
        <link rel="stylesheet" href="assets/css/loginform.css">
        <!-- Products page -->
        <link rel="stylesheet" href="../assets/css/productspage.css">

</head>

<style>

  body{
    margin: 0;
    padding: 0;
    overflow: hidden;
  }


/* Login modal CSS */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: rgba(0, 0, 0, 0.4);
  
}

.modal-content {
  background-color: #fefefe;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  padding: 50px;
  border: 1px solid #888;
  width:40%;
  height:70%;
  border-radius: 50px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 24px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}




		.dropdown {
				position: relative;
				display: inline-block;
			}

			.dropdown-content {
				background:gray;
				display: none;
				position: absolute;
				z-index: 1;
			}

			.dropdown:hover .dropdown-content {
				display: block;
			}

			.dropdown-content a {
				color: #000;
				padding: 12px 16px;
				text-decoration: none;
				display: block;
			}

			.dropdown-content a:hover {
				background-color: #f1f1f1;
			}
			







/* Product search bar */

.products-search-container {
  background-color: #ffd6ff;
  margin: 130px 100px 0 100px;
  display: flex;
  border-radius: 5px;
  align-items: center;
  padding-left: 15px;
}

input {
  width: 240px;
  padding: 5px;
  border-radius: 5px;
  outline: none;
  background: white;
  font-size: 18px;
}

button {
  border: none;
  background-color: #FF6F61;
  color: white;
  padding: 8px 15px;
  border-radius: 5px;
  margin-left: 10px;
  cursor: pointer;
}

.products-search-container form {
  display: flex;
  align-items: center;
}


.product-header-container{
  background-color: #ffd6ff;
  margin: 10px 100px 0 100px;
  /* display: flex; */
  border-radius: 5px;
 
}


/* .product-search{

  height: 60px;
  width: auto;
  padding: 15px;
  display: flex;
  justify-content:space-between;
  align-items: center;
  
}
input{
  width: 240px;
  padding: 5px;
  border-radius: 5px;
  outline: none;
  background: white;
  font-size: 18px;
}


.fa-magnifying-glass{
  padding: 5px;
}

.fa-magnifying-glass:hover{
  color: skyblue;
  cursor: pointer;
} */


.product-page{
  background: #eaf4f4;
  margin: 10px 100px 0 100px;
  padding: 30px;
  height: 75%;
  border-radius: 5px;
  display: flex; 
  flex-direction: row;
  width: auto;
  flex-wrap: wrap;
}


.product-box {
	position: relative;
  padding: 15px;
  border: 1px solid none;
}
.product-box:hover{
	padding: 10px;
	border: 1px solid var(--text-color);
	transition: 0.4s;
}

.product-img{
	width: 150px;
	height: 150px;
	margin-bottom: 0.5rem;
}
.product-title {
	font-size: 1.1rem;
	font-weight: 600;
  text-align: center;
	text-transform: uppercase;
	margin-bottom: 0.5rem;
	color: #ad1845;
  word-wrap: break-word;
}

.price{
	font-weight: 300;
  font-size: 1rem;
}
.stocks{
	font-weight: 300;
  font-size: 1rem;
  float:right;
}


.rating .fa{
    color: orange;
    font-size: 15px;

}



  </style>
    
 