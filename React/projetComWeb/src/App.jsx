import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'

function Formulaire(props) {
  const [nom, setNom] = useState("");
  const [prenom, setPrenom] = useState("");
  //Changer le style une fois connecté
  const Click = () => {
    props.action(nom, prenom);
  }

  // Le style pour la connexion change lorsqu'on cherche à se connecter
  const container = props.showNotes ? "login-container-connected" : "login-container";
  const title = props.showNotes ? "login-title-connected" : "login-title";
  const login = props.showNotes ? "login-form-connected" : "login-form";
  const form = props.showNotes ? "form-group-connected" : "form-group";

  return (
    <>
      <div className={container}>
        <h2 className={title}>Connexion Étudiant</h2>
        <form className={login}>

          <div className={form}>
            <label>Entrez votre prénom : </label>
            <input type="text" onChange={(e) => setPrenom(e.target.value)} required /><br /><br />
          </div>

          <div className="form-group">
            <label>Entrez votre nom : </label>
            <input type="text" onChange={(e) => setNom(e.target.value)} required /><br /><br /><br />
          </div>

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

  const ActionBoutonGet = (nom, prenom) => {

    fetch(`https://lhermouet.zzz.bordeaux-inp.fr/reponse.php/?prenom=${prenom}&nom=${nom}`)
      .then(r => r.text())
      .then(txt => {
        var datas = JSON.parse(txt);
        if (datas.vals && datas.vals.length > 0) {
          setData(datas.vals);
          //console.log(datas);
          setNom(nom);
          setPrenom(prenom);
          // console.log(nom)
          setShowNotes(true);
        } else {
          setData([]);
          setShowNotes(false);

        }
      })
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
          <div className="notes-container">
            <br></br>
            <h1>Note de {prenom} {nom}</h1><br></br>
            {data.map((item) => {
              return <Notes key={item.Libelle} libelle={item.Libelle} note={item.Note} />
            })}
          </div>
        </>
      )
      }
      {(!showNotes && data.length === 0 && (nom || prenom)) && (
        <p>Aucune note trouvée pour {prenom} {nom}.</p>
      )}
    </>
  );
}

export default App