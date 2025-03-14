<script setup>
import { ref, watch } from 'vue'

const rail = ref(true)
</script>
<template>
    <v-layout>
        <v-navigation-drawer
            expand-on-hover
            :rail="rail"
        >
            <v-list>
                <v-list-item
                    prepend-icon="mdi-account"
                    subtitle="admin@gmailcom"
                    title="Admin"
                ></v-list-item>
            </v-list>

            <v-divider></v-divider>

            <v-list density="compact" nav>
                <v-list-item href="#" prepend-icon="mdi-home" title="Home" value="home"></v-list-item>
                <v-list-item href="/schedules" prepend-icon="mdi-calendar" title="Schedules" value="schedules"></v-list-item>
                <v-list-item href="#" prepend-icon="mdi-calendar-edit" title="Create Schedule" value="createSchedule"></v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar>
            <v-app-bar-nav-icon variant="text" @click.stop="rail = !rail"></v-app-bar-nav-icon>
            <v-app-bar-title>Scheduling Website</v-app-bar-title>

        </v-app-bar>

        <v-main>
            <v-container fluid>
                <slot/>
            </v-container>
        </v-main>
    </v-layout>
</template>