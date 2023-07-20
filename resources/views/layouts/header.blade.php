
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Multiple Laravel App Support with one docker Image</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  </head>
  <body>
    <nav>
      <div class="container1">
        <div class="wrap-1">
          <img 
            src="image/logo.png"
            alt="bootstrap"
          />
          <div class="ser"> <span class="fa-solid fa-magnifying-glass"></span>
          <input type="search" class="search" placeholder="Search Medium" /></div>
         
        </div>
        <div class="wrap-2">
          <div class="icon">
            <i class="fa-regular fa-pen-to-square"></i>
            <p id="write">Write</p>
          </div>
          <div class="button">
            <button class="btn signup">Sign up</button>
            <button class="btn">Sign in</button>
          </div>
        </div>
      </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    @yield('content')
  
  </body>
</html>
<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.container1 {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px;
  box-shadow: #616060;
  border-bottom: solid 1px #F2F2F2;
}
.ser{
    background-color: #f0f0f0;
    border-radius: 14px;
}
.wrap-1{
    display: flex;
    align-items: center;
    gap: 10px;
}
.wrap-1 img {
  width: 64px;
  height: 37px;

} 
.fa-solid {
  font-size: 20px;
  color: #616060;
  margin-left: 10px;
}
.search {
  font-size: 14px;
  padding: 10px;
  border: none;
  outline: none;
  /* margin-bottom:  5px; */
  background-color: #f0f0f0;
  border-radius: 14px;
  
}
.wrap-2 {
  display: flex;
  gap: 25px;
  margin-right: 40px;
}
.icon {
  display: flex;
  align-items: center;
  gap: 7px;
}

.fa-regular {
  font-size: 22px;
  color: #616060;
}
#write {
  color: #616060;
  font-size: 17px;
}
.btn {
  font-size: 14px;
  padding: 8px;
  width: 80px;
  border-radius: 20px;
  border: none;
  outline: none;
  color: #616060;
}
.signup {
  background-color: #199219;
  color: #fff;
}

</style>