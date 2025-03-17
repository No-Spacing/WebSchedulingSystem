<script setup>
import Layout from '../Layouts/Main.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

defineOptions({ layout: Layout })

defineProps ({ schedules: Object })

const form = useForm({
    title: null,
    roomNo: null,
    date: null,
    startTime: null,
    endTime: null,
})

function submit() {
  form.post('/update-schedule',{
    onSuccess: () => {
        form.reset();
    },
  })
}

const updateDialog = ref(false);
</script>
<template>
    <v-card title="Schedules" subtitle="List of schedules">
        <v-card-text>
            <v-text-field label="Search" variant="outlined"></v-text-field>
            <v-table>
                <thead>
                    <tr>
                        <th class="text-left">
                            Title
                        </th>
                        <th class="text-left">
                            Room No.
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
                    <tr v-for="item in schedules.data">
                        <td>{{ item.title }}</td>
                        <td>{{ item.room }}</td>
                        <td>{{ item.date }}</td>
                        <td>{{ item.startTime }} - {{ item.endTime }}</td>
                        <td>
                            <v-btn icon="mdi-pencil" @click="updateDialog = true" class="ma-2 pa-2" size="x-small"></v-btn>
                            <v-btn icon="mdi-trash-can-outline" class="ma-2 pa-2" size="x-small"></v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
            <v-pagination :length="4"></v-pagination>
        </v-card-text>
    </v-card>
    <v-dialog v-model="updateDialog" width="auto"
    >
        <v-card
            title="Update Schedule" subtitle="Edit schedule form" width="450px" :loading="form.processing"
        >
            <v-form @submit.prevent="submit">
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
                            v-model="form.roomNo" 
                            :error-messages="form.errors.roomNo" 
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
                            :error-messages="form.errors.startTime" 
                            type="time" 
                            class="ma-1 pa-1" 
                            variant="outlined" 
                            label="Start Time"
                        ></v-text-field>
                        <v-text-field 
                            v-model="form.endTime" 
                            :error-messages="form.errors.endTime" 
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
</template>