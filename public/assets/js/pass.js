        var state= false;
function tooglePassword(){
    if(state){
    document.getElementById("password").setAttribute("type","password");
    document.getElementById("eye").style.color='#7a797e';
    state = false;
     }
     else{
    document.getElementById("password").setAttribute("type","text");
    document.getElementById("eye").style.color='#5887ef';
    state = true;
     }
}
 function password_generator( ) {
        var ok = 'azertyupqsdfghjkmwxcvbn23456789AZERTYUPQSDFGHJKMWXCVBN';
        var pass = '';
        longueur = 15;
        for(i=0;i<longueur;i++){
            var wpos = Math.round(Math.random()*ok.length);
            pass+=ok.substring(wpos,wpos+1);
        }
        document.getElementById("password").value = pass;
    }

