<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - 2</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>

<body>
    <div id="quizVue">
        <input id="showData" v-model="username"></input>
        <button v-if="clicked === false" v-on:click="add">Add</button>
        <button v-if="clicked === true" v-on:click="update">Update</button>

        <ul>
            <li v-for="(info, index) in infos"> {{info.name}}
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
                infos: [{
                        name: 'Muhammad Iqbal Mubarok'
                    },
                    {
                        name: 'Ruby Purwanti'
                    },
                    {
                        name: 'Faqih Muhammad'
                    },
                ],
                clicked: false,
                username: '',
            },
            methods: {
                add: function() {
                    input = document.getElementById('showData').value;
                    if (input != '') {
                        dataQuiz.infos.push({
                            name: input
                        })
                        dataQuiz.username = '';
                    } else {
                        confirm("Sorry, there's no data")
                    }
                },
                delete: function(index) {
                    if (confirm("Are you sure ?")) {
                        dataQuiz.infos.splice(index, 1);
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
            }
        });
    </script>

</body>

</html>