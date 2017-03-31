var myNumber = 45;

// Egalité SIMPLE : vérifier la valeur de la variable
console.log( myNumber == 45 ); // => true
console.log( myNumber == "45" ); // => true


// Inégalité SIMPLE : vérifier la valeur de la variable
console.log( myNumber != 45 ); // => false
console.log( myNumber != "45" ); // => false
console.log( myNumber != 12 ); // => true
console.log( myNumber != "12" ); // => true


// Egalité STRICTE : vérifier la valeur ET le type de la variable
console.log( myNumber === 45 ); // => true
console.log( myNumber === "45" ); // => false


// Inégalité STRICTE : vérifier la valeur ET le type de la variable
console.log( myNumber !== 45 ); // => false
console.log( myNumber !== "45" ); // => true


// Supérieur/inférieur
console.log( myNumber > 46 ); // => false
console.log( myNumber < 46 ); // => true


// Supérieur ou égal / inférieur ou égal
console.log( myNumber >= 12 ); // => true
console.log( myNumber <= 20 ); // => false

console.log( myNumber >= 45 ); // => true
console.log( myNumber <= 45 ); // => true