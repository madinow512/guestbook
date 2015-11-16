function scorePassword(pass) {
    var score = 0;
    if (!pass)
        return score;

    // award every unique letter until 5 repetitions
    var letters = new Object();
    for (var i=0; i<pass.length; i++) {
        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
        score += 5.0 / letters[pass[i]];
    }

    // bonus points for mixing it up
    var variations = {
        digits: /\d/.test(pass),
        lower: /[a-z]/.test(pass),
        upper: /[A-Z]/.test(pass),
        nonWords: /\W/.test(pass)
    }

    variationCount = 0;
    for (var check in variations) {
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 10;

    return parseInt(score);
}

function checkPassStrength(passwordInput) {
    var pass = passwordInput.val();
    var score = scorePassword(pass);
    var scoreClass = "veryweak" ;
    var scoreText = "sehr schwach" ;
     if(score >= 0 && score <= 30){
         scoreClass = "veryweak" ;
         scoreText = "sehr schwach" ;
    }else if(score > 30 && score <= 60){
         scoreClass = "weak" ;
         scoreText = "schwach" ;
    }else if(score > 60 && score <= 80){
         scoreClass = "medium" ;
         scoreText = "mittel" ;
    }else if(score > 80){
         scoreClass = "strong" ;
         scoreText = "stark" ;
    }
    $('#strength_human').text("Passwort: "+scoreText);
    $('.strength_meter').removeClass("veryweak weak medium strong");
    $('.strength_meter').addClass(scoreClass);
}