import './ShowTodo.css'
import { useState } from 'react'

const ShowTodo = ()=> {

    const checkbox_element = document.getElementById('btn-showcheckbox')

    let [selectDate , setSelectDate] = useState("") ;

    let [checkedBox , setCheckedBox] = useState(false) ;

    let allTodo = localStorage.getItem('todos') !== null ? JSON.parse(localStorage.getItem('todos')) : []

    let notDone = allTodo.filter( (value) =>  value.status === false && value.date === selectDate  )

    let doneTodo = allTodo.filter( (value) => value.status === true && value.date === selectDate  )

    const changeStatus = (id) => {

            for(let i = 0 ; i <= allTodo.length ; i++ ) {
                if(allTodo[i].id === id){
                    allTodo[i].status = true ;
                    localStorage.setItem('todos' , JSON.stringify(allTodo))
                }
            }
        }

    

    

    

    return (
        <div className="container">


            <div className="filter">
                <div className="checkbox-box">
                    <span>Check To Show Done</span>
                    <input onClick={()=> setCheckedBox(!checkedBox) } id='btn-showcheckbox' type="checkbox" className='checkbox-input' />
                </div>
                <div className="select-date">
                    <input type="date" onChange={(e)=> setSelectDate(e.target.value) }  />
                </div>
            </div>


            <div className="todolist-box">
                <table className='table table-hover'>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date </th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {
                            checkedBox && doneTodo.map((value , index) => {

                                return (<tr key={value.id}> 
                                        <td> {value.title }</td>
                                        <td> {value.date } </td>
                                        <td><input type="button" onClick={()=> changeStatus(value.id)}  value="Not Done" /></td>
                                        </tr>
                                        )
                            })
                        }

                        {

                            notDone.map((value , index) => {

                                return (<tr key={value.id}> 
                                        <td> {value.title }</td>
                                        <td> {value.date } </td>
                                        <td><input type="button" onClick={()=> changeStatus(value.id)}   value="Not Done" /></td>
                                        </tr>
                                        )

                            })
                            
                        }

                        
                    </tbody>
                </table>
            </div>

        </div>
    )
}

export default ShowTodo ;