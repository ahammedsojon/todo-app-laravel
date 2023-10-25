<template>
    <div class="todos-container">
        <div class="todos">
            <div class="heading-title">Todo App</div>
            <form @submit.prevent="manageTodo">
                <div class="form-group">
                    <input type="text" name="title" placeholder="Add Todo" v-model="todo.title">
                    <button class="btn" type="submit">{{todo.id ? 'Update' : 'Add'}}</button>
                </div>
                <div class="error-report" v-if="error">{{error['title'][0]}}</div>
            </form>
            <div class="todo-list">
                <div class="todo" v-if="todos.length > 0" v-for="(each, index) in todos">
                    <div :class="{title: true, complete: each.complete }">{{each.title}}</div>
                    <div class="actions">
                        <button class="btn edit" @click="editTodo(each)" v-if="!each.complete">
                            <i class="las la-pen"></i>
                        </button>
                        <button class="btn delete" @click="deleteTodo(each.id)">
                            <i class="las la-trash-alt"></i>
                        </button>
                        <button class="btn complete" v-if="!each.complete" @click="updateStatus(each)">
                            <i class="las la-check-double"></i>
                        </button>
                        <button class="btn not-complete" v-if="each.complete" @click="updateStatus(each)">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                </div>
                <div class="not-found" v-if="todos.length === 0">
                    No todo found
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import apiService from "../../Services/apiService.js";
import apiRoutes from "../../Services/apiRoutes.js";

export  default {
    data(){
        return {
            todo: {
                id: '',
                title: '',
                complete: false
            },
            todos: [],
            error: null
        }
    },
    methods: {
        manageTodo(e, data = null){
            this.error = null;
            const todoData = data ? data : this.todo
            console.log(todoData)
            const apiUrl = todoData.id ? apiRoutes.todoUpdate : apiRoutes.todoCreate;
                apiService.POST(apiUrl, todoData, (res) => {
                if (res.status === 200) {
                    this.GetTodos();
                    this.todo = {
                        title: '',
                        complete: false
                    }
                } else {
                    this.error = res.errors || res.error;
                }
            })
        },
        GetTodos: function () {
            apiService.POST(apiRoutes.todoList, null, (res) => {
                if (parseInt(res.status) === 200) {
                    this.todos = res.data
                }
            })
        },
        editTodo: function (data) {
            this.todo = {...data}
        },
        deleteTodo: function (id) {
            apiService.POST(apiRoutes.todoDelete, {id}, (res) => {
                if (parseInt(res.status) === 200) {
                    this.GetTodos();
                }else{
                    this.error = res.errors || res.error;
                }
            })
        },
        updateStatus: function (data) {
           const todoData = {...data, complete: !data.complete};
            this.manageTodo(event, todoData);
        },
    },
    mounted() {
        this.GetTodos()
    }
}
</script>
