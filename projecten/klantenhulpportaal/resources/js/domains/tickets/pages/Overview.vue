<script setup lang="ts">
import { TicketStore } from '../store';


</script>

<template> 
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Categorieen</th>
            <th>Status</th>
            <th>Aangemaakt door</th>
            <th>Aangemaakt op</th>
            <th>Laatste update op</th>
            <th>Toegewezen aan</th>
        </tr>
    </thead>
    <tbody>
        <!-- v-for gebruiken om door alles tickets heen te gaan. -->
        <!-- <tr>
            <td>{{ id }}</td>
            <td>{{ title }}</td>
            <td>{{ category }}</td>
            <td>{{ status }}</td>
            <td>{{ created_by }}</td>
            <td>{{ created_on }}</td>
            <td>{{ updated_on }}</td>
            <td>{{ assigned_to }}</td>
        </tr> -->
    </tbody>
</table>
</template>