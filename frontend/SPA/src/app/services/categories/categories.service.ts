import axios from 'axios';
import { Injectable, Inject } from '@angular/core';

@Injectable({
    providedIn: 'root'
})

export class CategoriesService {
    constructor(
        @Inject('BASE_URL') private baseUrl: string,
    ) { }

    async list() {
        try {
            const response = await axios.get(`${this.baseUrl}/categories`);
            return response.data;
        } catch (error) {
            console.log(error);
            return [];
        }
    }
}