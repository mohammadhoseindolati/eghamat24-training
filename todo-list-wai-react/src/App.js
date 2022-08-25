import { useState } from 'react'
import './App.css'
// import { Link } from 'react-router-dom'
import  Header from './components/Header/Header'
import ShowTodo from './components/ShowTodo/ShowTodo'

const App =  () => {
    return (
    <>
      <Header />
      <ShowTodo/>
    </>
    )
  }

  export default App 