<template>
    <div>
        <h1>Users Data</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="userInfo in user" :key="userInfo.id">
                    <td>{{ userInfo.name }}</td>
                    <td>{{ userInfo.email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data() {
            return {
                user: [],
            };
        },

        mounted(){
            this.getUser();
        },

        methods:{
            getUser(){
                axios.get('/api/getUserInfo')
                .then(response=>{
                    this.user = response.data;
                })
                .catch(error=>{
                    console.error(error);
                });
            }
        }
    }
</script>

<style>
</style>

Route::get('/getUserInfo',[UserRepository::class, 'getUserInfo'])->name('api.getUserInfo');

public function getUserInfo()
{
    $users = User::select('name', 'email')->get();

    return response()->json($users);

}
