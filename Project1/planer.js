function animateGame(){
        var gameDiv = document.getElementById('gamePage');
        var aboutDiv = document.getElementById('aboutPage');
        if(aboutDiv.style.display != "none"){
          aboutDiv.style.display ="none";
        }
        if(gameDiv.style.display == "none"){
          gameDiv.style.opacity = 0.0;
          gameDiv.style.display = "block";
          var opacity = 0;
          function frame(){
            opacity += 0.1;
            gameDiv.style.opacity = opacity;
            if(opacity == 1.0){
              clearInterval(id);
            }
            
          }
          var id = setInterval(frame,100);
        }
      }
      function animateAbout(){
        var gameDiv = document.getElementById('gamePage');
        var aboutDiv = document.getElementById('aboutPage');
        if(gameDiv.style.display != "none"){
          gameDiv.style.display ="none";
        }
        if(aboutDiv.style.display == "none"){
          aboutDiv.style.opacity = 0.0;
          aboutDiv.style.display = "block";
          var opacity = 0;
          function frame(){
            opacity += 0.1;
            aboutDiv.style.opacity = opacity;
            if(opacity == 1.0){
              clearInterval(id);
            }
            
          }
          var id = setInterval(frame,100);
        }
      }