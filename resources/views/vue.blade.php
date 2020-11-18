<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - 2</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <div id="quizVue">
        <input id="showData" v-model="username"></input>
        <button v-if="clicked === false" v-on:click="add">Add</button>
        <button v-if="clicked === true" v-on:click="update">Update</button>

        <ul>
            <li v-for="(info, index) in infos"> @{{info.name}}
                <button v-on:click="edit(index,info)">Edit</button>
                ||
                <button v-on:click="hapus(index,info)">Delete</button>
            </li>
        </ul>

    </div>

    <script>
        var dataQuiz = new Vue({
            el: '#quizVue',
            data: {
                iArray: 0,
                infos: [],
                clicked: false,
                username: '',
                idUser:'',
            },
            methods: {
                add: function() {
                    input = document.getElementById('showData').value;
                    if (input != '') {
                        axios.post(`api/users`, {name: input})
                            .then(response => {
                                axios.get('api/users').then(response => this.infos = response.data.users);
                        })
                        dataQuiz.username = '';
                    } else {
                        confirm("Sorry, there's no data")
                    }
                },
                hapus: function(index, info) {
                    if (confirm("Are you sure ?")) {
                        axios.delete(`api/users/delete/` + info.id)
                        .then(response => {
                            axios.get('api/users').then(response => this.infos = response.data.users);
                        console.log(response.data);
                        })
                    }
                },
                edit: function(index,info) {
                    dataQuiz.idUser = info.id;
                    dataQuiz.iArray = index;
                    dataQuiz.username = dataQuiz.infos[index].name;
                    dataQuiz.clicked = true;
                    console.log(dataQuiz.idUser)
                },
                update: function() {
                    input = document.getElementById('showData').value;
                    axios.post(`api/users/update/` + dataQuiz.idUser, {name: input})
                    .then(response => {
                        axios.get('api/users').then(response => this.infos = response.data.users);
                    })
                    dataQuiz.infos[dataQuiz.iArray].name = input;
                    dataQuiz.username = '';
                    dataQuiz.clicked = false;
                },
            },
            mounted() {
                axios.get('api/users').then(response => this.infos = response.data.users);
            }

        });
    </script>

</body>

</html>