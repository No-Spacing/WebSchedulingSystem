<script setup>
import Layout from '../Layouts/Main.vue'
import { useForm } from '@inertiajs/vue3'

defineOptions({ layout: Layout })

const form = useForm({
    title: null,
    roomNo: null,
    date: null,
    startTime: null,
    endTime: null,
})

function submit() {
  form.post('/post-schedule',{
    onSuccess: () => {
        form.reset();
    },
  })
}
</script>
<template>
    <v-card title="Create Schedule" subtitle="Schedule form" :loading="form.processing">
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
                <v-card-actions class="d-flex justify-center">
                    <v-btn type="submit" size="x-large" block variant="outlined" :loading="form.processing">Submit</v-btn>
                </v-card-actions>
            </v-card-text>
        </v-form>
    </v-card>
</template>