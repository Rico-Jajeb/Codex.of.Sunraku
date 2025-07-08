<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <main class="pt-10">
       
            <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12 mb-36 bg-white overflow-hidden shadow-xl rounded-lg">

                <nav class="grid  grid-cols-1 px-4 md:grid-cols-3 gap-4 pt-8 mb-8">

                    <Link href="/systemProjects">
                        <div class="bg-blue-200  shadow-lg  h-36  rounded-lg flex justify-center items-center transition transform hover:-translate-y-2">
                            <h1 class="text-lg font-mono font-bold">
                                {{ ProjectCounts2 }} Projects 
                            </h1>
                            <Chart type="pie" :data="chartData2" :options="chartOptions2" class="md:w-28" />
                        </div>
                    </Link>
                    <Link href="/techSkill">
                        <div class="bg-orange-200  shadow-lg  h-36  rounded-lg flex justify-center items-center transition transform hover:-translate-y-2">
                            <h1 class="text-lg font-bold font-mono">
                                {{ SkillCounts2 }} Skills 
                            </h1>
                            <Chart type="pie" :data="chartData4" :options="chartOptions4" class="md:w-28" />
                        </div>
                    </Link>  
                    <Link href="/achievement">
                        <div class="bg-gray-200  shadow-lg  h-36  rounded-lg flex justify-center items-center transition transform hover:-translate-y-2">
                        <h1 class="text-lg font-bold font-mono">
                                {{ AwardCounts2 }} Awards
                        </h1>    
                            <Chart type="pie" :data="chartData5" :options="chartOptions5" class="md:w-28" />
                        </div>
                    </Link>
                  
                </nav>

                <div class="mt-4 px-4 md:px-0">
                    <label class="mr-2 font-bold">Select Year:</label>
                    <select v-model="selectedYear" class="border rounded p-1">
                        <option v-for="year in availableYears" :key="year" :value="year">
                            {{ year }}
                        </option>
                    </select>
                </div>

                <article class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <section class="md:col-span-3  ">
                        <div class="card mt-8 px-4 md:px-0">
                            <Chart type="bar" :data="chartData3" :options="chartOptions3" class="h-[30rem]" />
                        </div>                        
                    </section>                    

                    <section class=" flex items-center justify-center ">
                        <div class="">
                            <div class="flex justify-center">
                                <Chart type="pie" :data="chartData" :options="chartOptions" class="md:w-80" />
                            </div>
                            <header class=" flex justify-center mt-2">
                                <h1 class="text-lg font-bold">Codex</h1>
                            </header>                            
                        </div>

                    </section>




                </article>
                <!-- <article class="grid  grid-cols-1 md:grid-cols-3 mt-20">
                        <section class="">
                            <div class=" flex justify-center">
                                <Chart type="pie" :data="chartData2" :options="chartOptions2" class="md:w-80" />
                            </div>
                            <header class=" flex justify-center mt-2">
                                <h1 class="text-lg font-bold">Project</h1>
                            </header>
                        </section>                   
                        <section class="mt-8 md:mt-0">
                            <div class=" flex justify-center">
                                <Chart type="pie" :data="chartData4" :options="chartOptions4" class="md:w-80" />
                            </div>
                            <header class=" flex justify-center mt-2">
                                <h1 class="text-lg font-bold">Skill</h1>
                            </header>
                        </section>                   
                        <section class="mt-8 md:mt-0">
                            <div class=" flex justify-center">
                                <Chart type="pie" :data="chartData5" :options="chartOptions5" class="md:w-80" />
                            </div>
                            <header class=" flex justify-center mt-2">
                                <h1 class="text-lg font-bold">Skill</h1>
                            </header>
                        </section>                   
                </article> -->
 


            </section>
        </main>
    </AppLayout>
   
</template>


<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import Chart from 'primevue/chart';
import { ref, onMounted, watch, computed } from "vue";

import { Link } from '@inertiajs/vue3'

const props = defineProps({
    data: Array,
    codex: Array,
    project: Array,
    skill: Array,
    award: Array,
});

const ProjectCounts2 = props.project ? props.project.filter(p => p.id).length : 0;
const SkillCounts2 = props.skill ? props.skill.filter(p => p.id).length : 0;
const AwardCounts2 = props.award ? props.award.filter(p => p.id).length : 0;



// Year filter
const selectedYear = ref(new Date().getFullYear());

const availableYears = computed(() => {
    const years = new Set();

    [...(props.data || []), ...(props.codex || [])].forEach(item => {
        if (item.created_at) {
            const year = new Date(item.created_at).getFullYear();
            years.add(year);
        }
    });

        // If no years found, fallback to current year
        if (years.size === 0) {
            years.add(new Date().getFullYear());
        }

        return Array.from(years).sort((a, b) => b - a);
    });

    const chartData = ref();
    const chartOptions = ref();
    const chartData2 = ref();
    const chartOptions2 = ref();
    const chartData3 = ref();
    const chartOptions3 = ref();
    const chartData4 = ref();
    const chartOptions4 = ref();
    const chartData5 = ref();
    const chartOptions5 = ref();

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    //--------------------------- CODEX -------------------------

    const setChartData = () => {
        const labels = props.data.map(item => item.category_name);
        const dataCounts = labels.map(labelName => {
            return props.codex.filter(codexItem => codexItem.category_name === labelName).length;
        });

        const backgroundColors = labels.map(() => getRandomColor());
        const hoverBackgroundColors = backgroundColors.map(() => getRandomColor());

        return {
            labels,
            datasets: [
                {
                    data: dataCounts,
                    backgroundColor: backgroundColors,
                    hoverBackgroundColor: hoverBackgroundColors
                }
            ]
        };
    };

    const setChartOptions = () => {
        const documentStyle = getComputedStyle(document.documentElement);
        const textColor = documentStyle.getPropertyValue('--p-text-color');

        return {
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        color: textColor
                    }
                }
            }
        };
    };

    //---------------------------- PROJECT ---------------------

    const setChartData2 = () => {
        const documentStyle = getComputedStyle(document.body);
        const dataCounts2 = props.project ? props.project.filter(p => p.id).length : 0;

        return {
            labels: ['Project'],
            datasets: [
                {
                    data: [dataCounts2],
                    backgroundColor: [
                        documentStyle.getPropertyValue('--p-cyan-500'),
                        documentStyle.getPropertyValue('--p-orange-500'),
                        documentStyle.getPropertyValue('--p-gray-500')
                    ],
                    hoverBackgroundColor: [
                        documentStyle.getPropertyValue('--p-cyan-400'),
                        documentStyle.getPropertyValue('--p-orange-400'),
                        documentStyle.getPropertyValue('--p-gray-400')
                    ]
                }
            ]
        };
    };

    const setChartOptions2 = () => {
        const documentStyle = getComputedStyle(document.documentElement);
        const textColor = documentStyle.getPropertyValue('--p-text-color');

        return {
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        color: textColor
                    }
                }
            }
        };
    };
    //----------------------- SKILL --------------------

    const setChartData4 = () => {
        const documentStyle = getComputedStyle(document.body);
        const dataCounts2 = props.skill ? props.skill.filter(p => p.id).length : 0;

        return {
            labels: ['Skill'],
            datasets: [
                {
                    data: [dataCounts2],
                    backgroundColor: [
                    
                        documentStyle.getPropertyValue('--p-orange-500'),
                        documentStyle.getPropertyValue('--p-gray-500')
                    ],
                    hoverBackgroundColor: [
                        
                        documentStyle.getPropertyValue('--p-orange-400'),
                        documentStyle.getPropertyValue('--p-gray-400')
                    ]
                }
            ]
        };
    };

    const setChartOptions4 = () => {
        const documentStyle = getComputedStyle(document.documentElement);
        const textColor = documentStyle.getPropertyValue('--p-text-color');

        return {
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        color: textColor
                    }
                }
            }
        };
    };
    //----------------------- award --------------------

    const setChartData5 = () => {
        const documentStyle = getComputedStyle(document.body);
        const dataCounts2 = props.award ? props.award.filter(p => p.id).length : 0;

        return {
            labels: ['Award'],
            datasets: [
                {
                    data: [dataCounts2],
                    backgroundColor: [
                    
                        
                        documentStyle.getPropertyValue('--p-gray-500')
                    ],
                    hoverBackgroundColor: [
                        
                      
                        documentStyle.getPropertyValue('--p-gray-400')
                    ]
                }
            ]
        };
    };

    const setChartOptions5 = () => {
        const documentStyle = getComputedStyle(document.documentElement);
        const textColor = documentStyle.getPropertyValue('--p-text-color');

        return {
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        color: textColor
                    }
                }
            }
        };
    };

    //-------------------------- CATEGORY AND CODEX -------------------------------
    const setChartData3 = () => {
        const documentStyle = getComputedStyle(document.documentElement);

        const months = [
            'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August',
            'September', 'October', 'November', 'December'
        ];

        const countPerMonth = (array, year) => {
            const counts = Array(12).fill(0);
            array.forEach(item => {
                if (item.created_at) {
                    const date = new Date(item.created_at);
                    if (date.getFullYear() === year) {
                        const monthIndex = date.getMonth();
                        counts[monthIndex]++;
                    }
                }
            });
            return counts;
        };

        const dataCounts = countPerMonth(props.data || [], selectedYear.value);
        const codexCounts = countPerMonth(props.codex || [], selectedYear.value);

        return {
            labels: months,
            datasets: [
                {
                    type: 'bar',
                    label: 'Category',
                    backgroundColor: documentStyle.getPropertyValue('--p-cyan-500'),
                    data: dataCounts
                },
                {
                    type: 'bar',
                    label: 'Codex',
                    backgroundColor: documentStyle.getPropertyValue('--p-orange-500'),
                    data: codexCounts
                }
            ]
        };
    };

    const setChartOptions3 = () => {
        const documentStyle = getComputedStyle(document.documentElement);
        const textColor = documentStyle.getPropertyValue('--p-text-color');
        const textColorSecondary = documentStyle.getPropertyValue('--p-text-muted-color');
        const surfaceBorder = documentStyle.getPropertyValue('--p-content-border-color');

        return {
            maintainAspectRatio: false,
            aspectRatio: 0.8,
            plugins: {
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    labels: {
                        color: textColor
                    }
                }
            },
            scales: {
                x: {
                    stacked: true,
                    ticks: {
                        color: textColorSecondary
                    },
                    grid: {
                        color: surfaceBorder
                    }
                },
                y: {
                    stacked: true,
                    ticks: {
                        color: textColorSecondary
                    },
                    grid: {
                        color: surfaceBorder
                    }
                }
            }
        };
    };

    onMounted(() => {
        chartData.value = setChartData();
        chartOptions.value = setChartOptions();

        chartData2.value = setChartData2();
        chartOptions2.value = setChartOptions2();

        chartData3.value = setChartData3();
        chartOptions3.value = setChartOptions3();

        chartData4.value = setChartData4();
        chartOptions4.value = setChartOptions4();

        chartData5.value = setChartData5();
        chartOptions5.value = setChartOptions5();

        watch(
            () => [props.data, props.codex, props.project, selectedYear.value],
            () => {
                chartData.value = setChartData();
                chartOptions.value = setChartOptions();

                chartData2.value = setChartData2();
                chartOptions2.value = setChartOptions2();

                chartData3.value = setChartData3();
                chartOptions3.value = setChartOptions3();

                chartData4.value = setChartData4();
                chartOptions4.value = setChartOptions4();

                chartData5.value = setChartData5();
                chartOptions5.value = setChartOptions5();
            },
            { immediate: true }
        );
    });
</script>


