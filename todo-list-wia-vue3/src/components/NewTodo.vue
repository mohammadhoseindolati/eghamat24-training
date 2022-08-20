<template>
  <div class="new-todo-box">
    <h3>Add new Todo</h3>
    <form>
      <label for="newtitle">New Title</label>
      <input id="newtitle" type="text" v-model.trim="newTitle">

      <label for="date">Date</label>
      <DatePicker v-model="newDate"></Datepicker>

      <button @click.prevent="testdate()">Add</button>
    </form>
  </div>
</template>

<script>
 import DatePicker from 'vue3-persian-datetime-picker'

export default {
    components: { DatePicker } ,
    data(){
        return {
          newTitle: '' ,
          newDate: '' ,
        }
    } ,
    methods : {
      addToDb(){
        let oldTodos = []
        oldTodos =  localStorage.getItem('todos') != null ? JSON.parse(localStorage.getItem('todos')) : []
        let todos = {
        title : this.newTitle ,
        date : this.newDate ,
        status :true
        }
        oldTodos.unshift(todos)
        localStorage.setItem('todos' , JSON.stringify(oldTodos) ) 
      } ,
      testdate(){
        console.log(this.newDate)
      }
    }
}
</script>

<style scoped>
.new-todo-box {
  width: 800px;
  margin: 0 auto ;
  border: 1px solid #eee;
  border-radius: 5px;
  padding: 10px 15px;
  text-align: center;
}
form {
  width: 100%;
}
form input {
  display: block;
  margin: 10px;
  width: 100%;
  height: 25px;
}
</style>