<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>home</title>
</head>
<body>
    <div class="container">
      <div class="nav">
         <h1 class="s-name">HITBAMAS</h1>
         

          <div class="ll">



           
        <input type="file" accept="image/*"  width="300px" placeholder="Logo" class="logo" id="ima">
        <img src="" id="image-preview" alt="">

           <span class="j">
        <img  src="/icons/home page icon/2849812_menu_multimedia_bars_media_icon.svg" alt=""  class="drop_down" onclick="toggle_dropdown2()" >
           </span>
    

         
          </div>
      </div>

       <div class="bod">

        <div id="bd_left" class="bod_left">


          

          <div class="bod_left_h">
      
         <img onclick="toggle_dropdown()" class="rgt" src="/icons/home page icon/1.png" alt="">
        <span class="yy"  onclick="toggle_dropdown()" > Previous attendance</span>

          </div>
          <div class="drop_down" id="mydrop">
          <a href="#"> <p class="days">Yesterday</p></a>
          <a href="#"> <p class="days">Last wweek</p></a>
          <a href="#"> <p class="days">Last month</p></a>

          </div>

         <a href="dashboard.php">  <span id="y" class="yy">Attendance dashboard</span></a>

        </div>

               <div id="bd_r"  class="bod_right">

                <a href="add_program.php" class="box1_link">

                <div class="box1">
                <div class="box">
                  <img src="/icons/home page icon/12.12.2024_06.43.00_REC-removebg-preview 1.png" alt="" class="ic">
                  </div>

                  <h2>add a program</h2>
                </div>

                </a>

                <a href="#" class="box1_link">

                  <div class="box1">
                  <div class="box">
                    <img src="/icons/home page icon/undraw_dashboard_re_3b76 1.png" alt="" class="ic">
                    </div>
  
                    <h2>attendance dashboard</h2>
                  </div>
  
                  </a>

                  <a href="period.php" class="box1_link">

                    <div class="box1">
                    <div class="box">
                      <img src="/icons/home page icon/Warstwa_1_1_.png" alt="" class="ic">
                      </div>
    
                      <h2>Mark attendance</h2>
                    </div>
    
                    </a>

                    <a href="add_student.php" class="box1_link">

                      <div class="box1">
                      <div class="box">
                        <img src="/icons/home page icon/12.12.2024_07.02.08_REC-removebg-preview 1.png" alt="" class="ic">
                        </div>
      
                        <h2>add student</h2>
                      </div>
      
                      </a>

                      
               
               </div> 
      </div>

    </div>
    <script src="home.js"></script>
</body>
</html>