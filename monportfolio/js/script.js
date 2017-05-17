// Consctructeur, ici on définit le langage maitrisé, notre compétence en % sur ce dernier langage, et la couleur qu'aura notre cercle de progression
function maitriseLangage(langage, competence, couleurDebut, couleurFin){
	this.langage = langage;
	this.competence = competence;
	this.couleurDebut = couleurDebut;
	this.couleurFin = couleurFin;
}

// Déclaration de notre tableau qui comprendra l'ensemble des langages maitrisés affichés sur le site
var tableauLangageMaitrise = [];

// On déclare ici les language (grâce au constructeur) et on les ajoute (push) dans le tableau:
var html = new maitriseLangage ('HTML5', 0.85, '#e54f27', '#ec662b');
tableauLangageMaitrise.push(html);

var css = new maitriseLangage ('CSS3', 0.85, '#1e63ad', '#399bd6');
tableauLangageMaitrise.push(css);

var bootstrap = new maitriseLangage ('Bootstrap', 0.75, '#080036', '#5e2c50');
tableauLangageMaitrise.push(bootstrap);

var wordpress = new maitriseLangage ('WordPress', 0.55, '#464646', '#21759a');
tableauLangageMaitrise.push(wordpress);

var javascript = new maitriseLangage ('Javascript', 0.60, '#63a92f', '#8dbf27');
tableauLangageMaitrise.push(javascript);

var jquery = new maitriseLangage ('jQuery', 0.70, '#172c45', '#193556');
tableauLangageMaitrise.push(jquery);

var angular2 = new maitriseLangage ('Angular2', 0.15, '#e43037', '#b52e31');
tableauLangageMaitrise.push(angular2);

var ajax = new maitriseLangage ('AJAX', 0.65, '#0173bc', '#6caee2');
tableauLangageMaitrise.push(ajax);

var php = new maitriseLangage ('PHP', 0.60, '#e6c900', '#f4e105');
tableauLangageMaitrise.push(php);

var sql = new maitriseLangage ('SQL', 0.60, '#9b488d', '#b676a7');
tableauLangageMaitrise.push(sql);

var symfony = new maitriseLangage ('Symfony', 0.15, '#000', '#575757');
tableauLangageMaitrise.push(symfony);

var nodejs = new maitriseLangage ('nodeJS', 0.35, '#46483d', '#90c53f');
tableauLangageMaitrise.push(nodejs);


// Fonction jQuery permettant d'afficher le cercle de progression
// value étant le % de remplissage, compris entre 0 et 1


function afficheCercles() { 
	tableauLangageMaitrise.forEach(function(attribut) {
		$('.circle.'+attribut.langage).circleProgress({
			value: attribut.competence,
			fill: {gradient: [[attribut.couleurDebut, .5], [attribut.couleurFin, .5]], gradientAngle: -Math.PI}
		}).on('circle-animation-progress', function(event, progress, stepValue) {
			$(this).find('strong').text(stepValue.toFixed(2).substr(1));
		});
	});
};

$('.competence').click(function(){
    setTimeout('afficheCercles()', 250); // em millisecondes
});

// Traitements pour le background des liens

$(".quiSuisJe").click(function() {
  $(this).addClass( "quiSuisJeActive" );
  $(".competence").removeClass( "competenceActive" );
  $(".realisations").removeClass( "realisationsActive" );
  $(".formation").removeClass( "formationActive" );
  $(".interets").removeClass( "interetsActive" );
  $(".contact").removeClass( "contactActive" );
});

$(".competence").click(function() {
  $(this).addClass( "competenceActive" );
  $(".quiSuisJe").removeClass( "quiSuisJeActive" );
  $(".realisations").removeClass( "realisationsActive" );
  $(".formation").removeClass( "formationActive" );
  $(".interets").removeClass( "interetsActive" );
  $(".contact").removeClass( "contactActive" );
});

$(".realisations").click(function() {
  $(this).addClass( "realisationsActive" );
  $(".competence").removeClass( "competenceActive" );
  $(".quiSuisJe").removeClass( "quiSuisJeActive" );
  $(".formation").removeClass( "formationActive" );
  $(".interets").removeClass( "interetsActive" );
  $(".contact").removeClass( "contactActive" );
});

$(".formation").click(function() {
  $(this).addClass( "formationActive" );
  $(".competence").removeClass( "competenceActive" );
  $(".realisations").removeClass( "realisationsActive" );
  $(".quiSuisJe").removeClass( "quiSuisJeActive" );
  $(".interets").removeClass( "interetsActive" );
  $(".contact").removeClass( "contactActive" );
});

$(".interets").click(function() {
  $(this).addClass( "interetsActive" );
  $(".competence").removeClass( "competenceActive" );
  $(".realisations").removeClass( "realisationsActive" );
  $(".formation").removeClass( "formationActive" );
  $(".quiSuisJe").removeClass( "quiSuisJeActive" );
  $(".contact").removeClass( "contactActive" );
});

$(".contact").click(function() {
  $(this).addClass( "contactActive" );
  $(".competence").removeClass( "competenceActive" );
  $(".realisations").removeClass( "realisationsActive" );
  $(".formation").removeClass( "formationActive" );
  $(".interets").removeClass( "interetsActive" );
  $(".quiSuisJe").removeClass( "quiSuisJeActive" );
});

//Traitement pour clore la navbar lors du "click" sur smartphone ou tablette

$('.nav a').on('click', function(){
	var windowWidth= $(window).width();
	if (windowWidth < 1000) {
		$('.navbar-toggle').click();
	}
});

//Traitement pour le submit du mail
$('form').on('submit', function() {
  if(($('#email').val().length === 0) || ($('#objet').val().length === 0) || ($('#message').val().length === 0)) {
      $('<p class="alert alert-danger">Tout les champs doivent être renseignés</p>').insertAfter($('button[type="submit"]'));
      return false
  } else {
    alert('Votre message a bien été envoyé');
  }
  //return false;
});