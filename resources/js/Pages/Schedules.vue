<script setup>
import Layout from '../Layouts/Main.vue'
import { ref, watch } from 'vue'
import { useForm, router } from '@inertiajs/vue3'

defineOptions({ layout: Layout })
const props = defineProps ({ schedules: Object })

let updateDialog = ref(false), snackbar = ref(false), snackbarText = ref("");


let form = useForm({
    id: null,
    title: null,
    room: null,
    date: null,
    startTime: null,
    endTime: null,
    search: null,
})


function dialog(data){
    this.updateDialog = true
    form.id = data.id
    form.title = data.title
    form.room = data.room
    form.date = data.date
    form.startTime = data.startTime
    form.endTime = data.endTime
}

function submit() {
  form.put('/update-schedule',{
    onSuccess: (success) => {
        if(!success.props.flash.message){
            this.updateDialog = false
            this.snackbar = true
            this.snackbarText = "Schedule updated."
        } 
    },
    onError: (error) => {
        console.log(error)
    }
  })
}

function remove(id) {
    if (confirm("Do you want to remove this schedule?") == true) {
        router.delete('/delete-schedule/' + id, {
            onSuccess: () => {
                this.snackbar = true
                this.snackbarText = "Schedule deleted."
            },
            onError: (error) => {
                console.log(error)
            }
        });
    } 
}

function paginations(){
    router.visit(props.schedules.links[props.schedules.current_page].url,
        { preserveState: true }
    )
}

watch(() => form.search,
    (newValue) => {
        router.get('/schedules',
            { search: newValue }, 
            { preserveState: true }
        )
    }
)
</script>
<template>
    <v-card title="Schedules" subtitle="List of schedules">
        <v-card-text>
            <v-text-field v-model="form.search" label="Search" variant="outlined"></v-text-field>
            <v-table>
                <thead>
                    <tr>
                        <th class="text-left">
                            No.
                        </th>
                        <th class="text-left">
                            Title
                        </th>
                        <th class="text-left">
                            Room
                        </th>
                        <th class="text-left">
                            Date
                        </th>
                        <th class="text-left">
                            Time
                        </th>
                        <th class="text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item, key in schedules.data">
                        <td>{{ ++key }}</td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.room }}</td>
                        <td>{{ item.date }}</td>
                        <td>{{ item.startTime }} - {{ item.endTime }}</td>
                        <td>
                            <v-btn icon="mdi-pencil" @click.prevent="dialog(item)" class="ma-2 pa-2" size="x-small"></v-btn>
                            <v-btn icon="mdi-trash-can-outline" @click="remove(item.id)" class="ma-2 pa-2" size="x-small"></v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
            <v-pagination v-model="schedules.current_page" :length="schedules.last_page" @update:modelValue="paginations()"></v-pagination>
        </v-card-text>
    </v-card>
    <v-dialog v-model="updateDialog" width="auto"
    >
        <v-card
            title="Update Schedule" subtitle="Edit schedule form" width="450px" :loading="form.processing"
        >
            <v-form @submit.prevent="submit()">
                <v-card-text>
                    <v-row>
                        <v-text-field 
                            v-model="form.title" 
                            :error-messages="form.errors.title" 
                            variant="outlined" 
                            class="ma-1 pa-1" 
                            label="Title"
                        ></v-text-field>
                    </v-row>
                    <v-row>
                        <v-text-field 
                            v-model="form.room" 
                            :error-messages="form.errors.room" 
                            variant="outlined"
                            class="ma-1 pa-1" 
                            label="Room No."
                        ></v-text-field>
                    </v-row>
                    <v-row>
                        <v-text-field 
                            v-model="form.date" 
                            :error-messages="form.errors.date"
                            type="date" 
                            class="ma-1 pa-1" 
                            variant="outlined" 
                            label="Date"
                        ></v-text-field>
                    </v-row>
                    <v-row>
                        <v-text-field 
                            v-model="form.startTime" 
                            :error-messages="form.errors.startTime || $page.props.flash.message" 
                            type="time" 
                            class="ma-1 pa-1" 
                            variant="outlined" 
                            label="Start Time"
                        ></v-text-field>
                    </v-row>
                    <v-row>
                        <v-text-field 
                            v-model="form.endTime" 
                            :error-messages="form.errors.endTime || $page.props.flash.message" 
                            type="time" 
                            class="ma-1 pa-1" 
                            variant="outlined" 
                            label="End Time"
                        ></v-text-field>
                    </v-row>
                    <v-card-actions class="d-flex justify-end">
                        <v-btn @click="updateDialog = false">Close</v-btn>
                        <v-btn type="submit" :loading="form.processing">Submit</v-btn>
                    </v-card-actions>
                </v-card-text>
            </v-form>
        </v-card>
    </v-dialog>
    <v-snackbar
        :timeout="2000"
        color="success"
        variant="outlined"
        v-model="snackbar"
        location="top"
        :text="snackbarText"
    >
    </v-snackbar>
</template>