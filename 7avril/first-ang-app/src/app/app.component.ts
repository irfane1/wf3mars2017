// Importer la class Component
import { Component } from '@angular/core';

// Définir le décorateur @Component({...})
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

// Exporter la class du component
export class AppComponent {

  title = 'Brand new Application';

  collection = ['Pierre', 'Paul', 'Jacques', 'Julien'];

  error = 'pasCool'

  openAlert(){
    alert('Salut')
  }

  sayHelloToUser(user){
    console.log('Hello '+ user)
  }

  awesome = 'Paulo'

}
