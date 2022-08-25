import ReactDOM from 'react-dom/client'
import { BrowserRouter as Router , Routes , Route } from 'react-router-dom'
import App from './App'
// import ShowTodo from './components/ShowTodo/ShowTodo'
import NewTodo from './components/NewTodo/NewTodo'


const root  = ReactDOM.createRoot(document.getElementById("root"))
root.render(
    <Router>
        <Routes>
            <Route path='/' element={ <App/> } />
            <Route path='/new' element={ <NewTodo/> } />
        </Routes>
    </Router>
)