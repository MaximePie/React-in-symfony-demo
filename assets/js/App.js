import React, {useEffect, useState} from "react";
// 8. Consultez le composant "Fishionary"


const baseUrl = "http://127.0.0.1:8000";

/**
 *
 */
function Fishionary() {

  const [fishes, setFishes] = useState([]);
  const [searchValue, setSearchValue] = useState('');

  /**
   * Ce code se déclenche à chaque fois que la valeur searchValue change.
   */
  useEffect(fetchFishes, [searchValue]);

  return (
    <div className="Fishionary">
      <p>Fishionary en place !</p>
      <input type="text" value={searchValue} onChange={(event) => setSearchValue(event.target.value)}/>
      {fishes.map(fish => (
        <div style={{border: "solid", margin: "8px 0"}}>
          <p>{fish.name}</p>
          <p>{fish.water}</p>
          <p>{fish.maxAge}</p>
        </div>
      ))}
      <button onClick={fetchFishes}>Hé oh ?</button>
    </div>
  )

  function fetchFishes() {

    let chain = '';
    if (searchValue) {
      chain += "?chain=" + searchValue;
    }

    fetch(baseUrl + "/searchfish" + chain).then(response => response.json()).then(data => {
      setFishes(data);
    })
  }
}

export default function App() {
  return (
    <div>
      <Fishionary/>
    </div>
  )
}
