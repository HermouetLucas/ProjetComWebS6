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
          <input type="text" onChange={(e) => setPrenom(e.target.value)} required /><br />

          <label>Entrez votre nom : </label>
          <input type="text" onChange={(e) => setNom(e.target.value)} required /><br />

          <button type="button" onClick={Click} disabled={!nom || !prenom}>Envoyer</button>
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
  const [data, setData] = useState([]);
  const [nom, setNom] = useState("");
  const [prenom, setPrenom] = useState("");
  const [showNotes, setShowNotes] = useState(false);
  const [erreur, setErreur] = useState(false);

  const ActionBoutonGet = (nom, prenom) => {

    fetch(`https://lhermouet.zzz.bordeaux-inp.fr/reponse.php/?prenom=${prenom}&nom=${nom}`)
      .then(r => r.text())
      .then(txt => {
        var datas = JSON.parse(txt);

        setData(datas.vals);
        //console.log(datas);
        console.log(showNotes)
        console.log(data)
        if (datas.vals.length > 0) {//pour une raison inconnue il faut continuer d'utiliser datas.vals içi
          setShowNotes(true);
          console.log("bon")
          setErreur(false);
          setNom(nom);
          setPrenom(prenom);
          // console.log(nom)


        }
        else {
          setShowNotes(false);
          console.log("pas bon")
          setErreur(true);
          setNom(nom);
          setPrenom(prenom);
        }
      }
      )
      .catch(err => {
        console.error("Erreur :", err);
        setData([]);
        setShowNotes(false);
      });
  }
  return (
    <>
      <Formulaire action={ActionBoutonGet} />
      {showNotes && (
        <>
          <br></br>
          <div className='notes-container'>
            <h1>Note de {prenom} {nom}</h1><br></br>
            {data.map((item) => {
              return <Notes key={item.Libelle} libelle={item.Libelle} note={item.Note} />
            })}
          </div>
        </>
      )
      }
      {(erreur) && (
        <p>L'élève {prenom} {nom} n'existe pas.</p>
      )}
    </>
  );
}

export default App
