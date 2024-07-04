import axios from 'axios';
import { Injectable, Inject } from '@angular/core';

@Injectable({
    providedIn: 'root'
})

export class FavoritesService {
    constructor(
        @Inject('BASE_URL') private baseUrl: string,
    ) { }

    async register(id: number = 1){
        try {
            const response = await axios.post(`${this.baseUrl}/favorites`, {
                employee: id
            });
            return response.data;
        } catch (error) {
            console.log(error);
            return [];
        }
    }

    async unregister(id: number = 1){
        try {
            const response = await axios.delete(`${this.baseUrl}/favorites/${id}`);
            return response.data;
        } catch (error) {
            console.log(error);
            return [];
        }
    }

}