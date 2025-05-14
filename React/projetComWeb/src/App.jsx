import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

function Formulaire() {
  return (
    <>
      <form action="reponse.php" method="get">
        <label for="prenom">Entrez votre prénom : </label>
        <input type="text" id="prenom" name="prenom" required /><br /><br />

        <label for="nom">Entrez votre nom : </label>
        <input type="text" id="nom" name="nom" required /><br /><br /><br />

        <button type="submit">Envoyer</button>
      </form>
    </>)
}

function Notes(props) {
  return (
    <>
      Note en Mathématique : {props.Mathematique}<br /><br />
      Note en Informatique : {props.Informatique}<br /><br />
      Note en Signal : {props.Signal}
    </>
  )
}

function App() {

  return (
    <>
      <Formulaire />
      <br /><br /><br />
      <Notes Mathematique Informatique Signal />
    </>
  )
}

export default App
