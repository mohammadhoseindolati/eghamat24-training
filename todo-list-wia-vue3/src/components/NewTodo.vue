<template>
  <div class="new-todo-box">
    <h3>Add new Todo</h3>
    <form>

      <div class="box1">
        <label for="newtitle">New Title</label>
        <input id="newtitle" type="text" v-model.trim="newTitle">
      </div>
      <div class="box2">
        <label>Date</label>
        <DatePicker class="add-date" v-model="newDate" ></Datepicker>
      </div>
      <button @click.prevent="addToDb()" class="btn btn-success btn-add ">Add</button>
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
          let todos = [{
          title : this.newTitle ,
          date : this.newDate ,
          status :false
        }]
        oldTodos = oldTodos.concat(todos)
        localStorage.setItem('todos' , JSON.stringify(oldTodos) )
        this.newTitle = ''
        this.newDate = ''
        alert("Todo Added Successful .")
      } ,
    }
  }
</script>

<style>
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
  form input#newtitle {
    display: block;
    width : 100% ;
    height: 35px;
    border: 1px solid #dadada;
    border-radius: 5px;
  }
  .add-date input {
    border: 1px solid #dadada;
    border-radius: 5px;
    height: 38px;
    border-left: none;
  }
  .box1,box2{
    margin: 15px 0;
  }
  .btn-add {
    margin-top: 20px;
  }
</style>