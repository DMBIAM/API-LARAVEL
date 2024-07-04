import axios from 'axios';
import { Injectable, Inject } from '@angular/core';

@Injectable({
    providedIn: 'root'
})

export class EmployeeService {
    constructor(
        @Inject('BASE_URL') private baseUrl: string,
    ) { }

    async getEmployess(page: number = 1) {
        try {
            const response = await axios.get(`${this.baseUrl}/employees?page=${page}`);
            return response.data;
        } catch (error) {
            console.log(error);
            return [];
        }
    }

    public sort(order: string = 'desc', employees: any[]) {
        let sortedEmployees: any[];
        if (order === 'desc') {
            sortedEmployees = employees.sort((a, b) => b.satisfaction - a.satisfaction);
        } else {
            sortedEmployees = employees.sort((a, b) => a.satisfaction - b.satisfaction);
        }
        return sortedEmployees;
    }
}