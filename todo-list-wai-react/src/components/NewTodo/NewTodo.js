import { useState } from 'react';
import './NewTodo.css'
import './../Header/Header'
import Header from './../Header/Header';

function NewTodo() {

  const [Title , setTitle ] = useState("") ;
  const [pickDate , setPickDate ] = useState("") ;

  let newTodo = [
    {
      id:Date.now() ,
      title:Title ,
      date:pickDate , 
      status:false
    }
  ]
  const oldTodo = localStorage.getItem('todos') !== null ? JSON.parse(localStorage.getItem('todos')) : []  ;

  let allTodo = oldTodo.concat(newTodo)

  const addToDb = (e)=> {
    e.preventDefault()
    if(Title !== "" && pickDate !== ""){

      localStorage.setItem('todos' , JSON.stringify(allTodo)) 

      setPickDate("")
      setTitle("")

      alert("Your Todo Added To List")

    }else {
      alert("Please Fill the Title and Date")
    }

  }

  return (
    <>
    <Header />
    <div className='container'>
      <form onSubmit={addToDb}>
        <label className='title'>
          <span>Title</span>
          <input type="text" onChange={(e)=> setTitle(e.target.value)} value={Title} />
        </label>

        <label>
          <span className='date'>Date</span>
          <input type="date"  onChange={(e) => setPickDate(e.target.value) } value={pickDate} />
        </label>

        <button >Add Todo</button>
      </form>
    </div>
    </>
  );
}

export default NewTodo;