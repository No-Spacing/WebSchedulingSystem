<script setup>
import Layout from '../Layouts/Main.vue'
import { ref } from 'vue'

defineOptions({ layout: Layout })

const updateDialog = ref(false);
</script>
<template>
    <v-card title="Schedules" subtitle="List of schedules">
        <v-card-text>
            <v-table>
                <thead>
                    <tr>
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
                    <tr>
                        <td>Room 101</td>
                        <td>14/03/2025</td>
                        <td>1:00AM - 2:00AM</td>
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
    <v-dialog
        v-model="updateDialog"
        width="auto"
    >
        <v-card
            title="Update Schedule"
            subtitle="Edit schedule form"
            width="450px"
        >
            <v-form>
                <v-card-text>
                    <v-text-field variant="outlined" label="Room No."></v-text-field>
                    <v-text-field type="date" variant="outlined" label="Date"></v-text-field>
                    <v-text-field type="time" variant="outlined" label="Start Time"></v-text-field>
                    <v-text-field type="time" variant="outlined" label="End Time"></v-text-field>
                    <v-card-actions class="d-flex justify-end">
                        <v-btn @click="updateDialog = false">Close</v-btn>
                        <v-btn>Submit</v-btn>
                    </v-card-actions>
                </v-card-text>
            </v-form>
        </v-card>
    </v-dialog>
</template>