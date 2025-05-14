import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

function Formulaire(props) {
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

function App() {

  return (
    <>
      <Formulaire />
    </>
  )
}

export default App
