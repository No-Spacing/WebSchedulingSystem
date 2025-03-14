<script setup>
import Layout from '../Layouts/Main.vue'

defineOptions({ layout: Layout })
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
                            <v-btn icon="mdi-pencil" class="ma-2 pa-2" size="x-small"></v-btn>
                            <v-btn icon="mdi-trash-can-outline" class="ma-2 pa-2" size="x-small"></v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>

        </v-card-text>
    </v-card>
</template>