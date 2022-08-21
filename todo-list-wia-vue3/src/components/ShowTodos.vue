<template>
  <div class="main">
    <h3>Todo list</h3>
    <div class="about-todo">
      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              # How to use Todo App
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">It is Very Easy You should Select to Date exp : Now or Another Date Then Click Show Button </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              # Wait ! . New Features are Adding at Next Version
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <a href="https://github.com/mohammadhoseindolati/eghamat24-training/tree/master/todo-list-wia-vue3">Repository on Github</a>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="main-top d-flex align-items-center mt-4 ">
      <div class="select-date flex-grow-1 d-flex justify-content-start  ">
        <DatePicker  color="#0d6efd" v-model="selectDate" ></DatePicker>
        <button class="btn btn-primary btn-show-todo-this-time" @click="selectTodosAtSpecialTime()">Show Todos of this Date</button>
      </div>
<!--      <div class="btn-show-todos flex-grow-1">-->
<!--        <button class="btn btn-success" v-on:click.left="showTodos()">Show Today s Todos</button>-->
<!--      </div>-->
      <div class="checkbox-done flex-grow-1">
        <div class="form-check checkbox-div d-flex align-items-center justify-content-center">
          <input class="checkbox-btn" type="checkbox" value="" id="show-done" @click="showDone" />
          <label class="form-check-label" for="show-done" >Show Done </label>
        </div>
<!--        <span>Show Done list : <input class="" type="checkbox" id="show-done" ></span>-->
      </div>
    </div>

    <div class="main-body mt-5">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">Title </th>
          <th scope="col">Date </th>
          <th scope="col">Done</th>
        </tr>
        </thead>
        <tbody>
        <tr scope="row" v-for="(todo,index) in todos"  :key="index">
          <td>{{ todo.title }}</td>
          <td>{{ todo.date }}</td>
          <td> <input type="button"  @click="doneTodo(index)" class="btn btn-warning" value="Click to Done"></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  import DatePicker from 'vue3-persian-datetime-picker'
  export default {
    components : {
      DatePicker
    } ,
    data(){
      return {
        todos : [],
        selectDate : "" ,
      }
    } ,
    methods : {
      // showTodos(){
      //   let allTodos = localStorage.getItem('todos') != null ? JSON.parse(localStorage.getItem('todos')) : [{ title : "لیستی وجود ندارد" , date : "---" , status :false }]
      //   let filterTodos =  allTodos.filter((todo) => todo.status === false)
      //   this.todos = this.todos.concat(filterTodos)
      // } ,
      doneTodo(index){
        let i = index
        this.todos[i].status = true
        localStorage.setItem('todos' , JSON.stringify(this.todos))
        this.todos = JSON.parse(localStorage.getItem('todos'))
      },
      showDone(){
        let checkbox_element = document.getElementById("show-done")
        if(checkbox_element.checked === true){
          this.todos = []
          let allTodos = localStorage.getItem('todos') != null ? JSON.parse(localStorage.getItem('todos')) : [{ title : "لیست انجام شده ای وجود ندارد" , date : "---" , status : true }]
          let filterTodos =  allTodos.filter((todo) => todo.status === true && todo.date === this.selectDate )
          this.todos = this.todos.concat(filterTodos)
        }else {
          this.todos = []
          let allTodos = localStorage.getItem('todos') != null ? JSON.parse(localStorage.getItem('todos')) : [{ title : "لیست انجام شده ای وجود ندارد" , date : "---" , status : false }]
          let filterTodos =  allTodos.filter((todo) => todo.status === false && todo.date === this.selectDate )
          this.todos = this.todos.concat(filterTodos)
        }
      } ,
      selectTodosAtSpecialTime(){
        let date = this.selectDate
        let allTodos = localStorage.getItem('todos') != null ? JSON.parse(localStorage.getItem('todos')) : [{ title : "لیست ای وجود ندارد" , date : "---" }]
        let selectedTodos =  allTodos.filter(function (todo){
          return todo.date === date && todo.status === false
        })
        this.todos = this.todos.concat(selectedTodos)
      }
    }

  }
</script>

<style>
  .main {
    text-align: center;
    width: 60%;
    margin: 0 auto;
  }
  table {
    padding: 10px;
    width: 100%;
  }

  td , th {
    padding: 8px;
    color: black;
    border: 1px solid #ccc;
  }
  .select-date span input {
    border: 1px solid #dadada;
    border-radius: 5px;
    height: 38px;
    border-left: none;
  }
  .checkbox-div {
    border: 1px solid #dadada ;
    border-radius: 5px;
    padding: 10px;
  }
  .checkbox-btn {
    margin-right: 10px;
    width: 15px;
    height: 15px;
  }
  .btn-show-todo-this-time {
    margin-left: 15px;
  }
</style>
