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
                <button v-on:click="edit(index)">Edit</button>
                ||
                <button v-on:click="delete(index)">Delete</button>
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
            },
            methods: {
                add: function() {
                    input = document.getElementById('showData').value;
                    if (input != '') {
                        axios.post(`api/users`, {name: input})
                            .then(response => {
                                this.infos.unshift({name: input});

                        })
                        dataQuiz.username = '';
                    } else {
                        confirm("Sorry, there's no data")
                    }
                },
                delete: function(index, user) {
                        if (confirm("Are you sure ?")) {

                }
                },
                edit: function(index) {
                    dataQuiz.iArray = index;
                    dataQuiz.username = dataQuiz.infos[index].name;
                    dataQuiz.clicked = true;
                },
                update: function() {
                    input = document.getElementById('showData').value;
                    dataQuiz.infos[dataQuiz.iArray].name = input;
                    dataQuiz.username = '';
                    dataQuiz.clicked = false;
                },
            mounted() {
                axios.get('api/users').then(response => this.infos = response.data.users);
                console.log('response');
            }
}

        });
    </script>

</body>

</html>