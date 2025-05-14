import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

function Formulaire(props) {
  const [nom, setNom] = useState("");
  const [prenom, setPrenom] = useState("");
  const Click = () => {
    props.action(nom, prenom);
  }

  return (
    <>
      <div className="login-container">
        <h2 className="login-title">Connexion Étudiant</h2>
        <form className="login-form">
          <label>Entrez votre prénom : </label>
          <input type="text" onChange={(e) => setPrenom(e.target.value)} required /><br /><br />

          <label>Entrez votre nom : </label>
          <input type="text" onChange={(e) => setNom(e.target.value)} required /><br /><br /><br />

          <button type="button" onClick={Click}>Envoyer</button>
        </form>
      </div>
    </>)
}

function Notes(props) {
  return (
    <>
      <p>{props.libelle} : {props.note}</p>

    </>)
}

function App() {
  const [data, setData] = useState([{ Note: "", Libelle: "" }]);
  const [nom, setNom] = useState("");
  const [prenom, setPrenom] = useState("");
  const ActionBoutonGet = (nom, prenom) => {

    fetch(`http://localhost/ProjetS6/reponse.php/?prenom=${prenom}&nom=${nom}`)
      .then(r => r.text())
      .then(txt => {
        var datas = JSON.parse(txt);
        setData(datas.vals);
        console.log(datas);
        setNom(nom);
        setPrenom(prenom);
        // console.log(nom)
      });
  }
  return (
    <>
      <Formulaire action={ActionBoutonGet} />
      <h1>Note de {nom} {prenom}</h1><br></br>
      {data.map((item) => {
        return <Notes key={item.Libelle} libelle={item.Libelle} note={item.Note} />
      })}
    </>
  )
}

export default App
