<template>
  <div class="main">
    <h3>All Todos</h3>
    <button v-on:click.left="showTodos">Show Today s Todos</button>
    <table>
      <thead>
      <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Done</th>
      </tr>
      </thead>
      <tbody>
        <tr v-for="(todo,index) in todos" v-show="todo.status" :key="index">
          <td>{{ todo.title }}</td>
          <td>{{ todo.date }}</td>
          <td> <input  @click="doneTodo($event)" type="checkbox" :class="todo-index"> </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data(){
    return {
      todos : [],
      display : ''
    }
  } ,
  methods : {
    showTodos(){
      let todos = localStorage.getItem('todos') != null ? JSON.parse(localStorage.getItem('todos')) : [{ title : "لیستی وجود ندارد" , date : "---"  }]

      this.todos = this.todos.concat(todos) 
    } ,
    doneTodo(event){
      console.log(event)
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

</style>