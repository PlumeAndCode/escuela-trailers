import React, { useEffect } from "react";
import { View, Text, ScrollView, RefreshControl } from "react-native";
import { Ionicons } from "@expo/vector-icons";
import { useCursosStore } from "../../src/stores/cursosStore";
import { Card } from "../../src/components/ui/Card";
import { Badge } from "../../src/components/ui/Badge";
import { Loading } from "../../src/components/ui/Loading";
import { Colors } from "../../src/constants/colors";

export default function CursosScreen() {
    const { cursos, isLoading, fetchCursos } = useCursosStore();

    useEffect(() => {
        fetchCursos();
    }, []);

    const getEstadoVariant = (estado: string): "success" | "warning" | "info" => {
        switch (estado) {
            case "activo":
                return "success";
            case "pendiente":
                return "warning";
            case "finalizado":
                return "info";
            default:
                return "info";
        }
    };

    const getEstadoLabel = (estado: string): string => {
        switch (estado) {
            case "activo":
                return "Activo";
            case "pendiente":
                return "Pendiente";
            case "finalizado":
                return "Finalizado";
            default:
                return estado;
        }
    };

    return (
        <View className="flex-1 bg-slate-100">
            {/* Header */}
            <View className="bg-slate-800 px-6 pt-14 pb-6">
                <Text className="text-2xl font-bold text-white">Mis Cursos</Text>
                <Text className="text-slate-400 mt-1">Progreso de tus cursos</Text>
            </View>

            {/* Lista de cursos */}
            <ScrollView
                className="flex-1 px-4 pt-4"
                refreshControl={<RefreshControl refreshing={isLoading} onRefresh={fetchCursos} />}
            >
                {isLoading && cursos.length === 0 ? (
                    <Loading message="Cargando cursos..." />
                ) : cursos.length === 0 ? (
                    <Card variant="outlined">
                        <View className="items-center py-8">
                            <Ionicons
                                name="school-outline"
                                size={48}
                                color={Colors.secondary[400]}
                            />
                            <Text className="text-slate-500 mt-4">
                                No estás inscrito en ningún curso
                            </Text>
                        </View>
                    </Card>
                ) : (
                    cursos.map((curso) => (
                        <Card key={curso.id} variant="elevated" className="mb-4">
                            <View className="flex-row items-start justify-between mb-3">
                                <View className="flex-1">
                                    <Text className="font-bold text-slate-800 text-lg">
                                        {curso.nombre}
                                    </Text>
                                    <Text className="text-slate-500 text-sm mt-1" numberOfLines={2}>
                                        {curso.descripcion}
                                    </Text>
                                </View>
                                <Badge
                                    label={getEstadoLabel(curso.estado_contratacion)}
                                    variant={getEstadoVariant(curso.estado_contratacion)}
                                />
                            </View>

                            {/* Barra de progreso */}
                            <View className="mt-2">
                                <View className="flex-row justify-between mb-1">
                                    <Text className="text-slate-600 text-sm">Progreso</Text>
                                    <Text className="text-amber-600 font-semibold">
                                        {curso.avance_porcentaje.toFixed(0)}%
                                    </Text>
                                </View>
                                <View className="h-3 bg-slate-200 rounded-full overflow-hidden">
                                    <View
                                        className="h-full bg-amber-500 rounded-full"
                                        style={{ width: `${curso.avance_porcentaje}%` }}
                                    />
                                </View>
                                <View className="flex-row justify-between mt-2">
                                    <Text className="text-slate-500 text-xs">
                                        {curso.lecciones_completadas} de {curso.total_lecciones}{" "}
                                        lecciones
                                    </Text>
                                    <Text className="text-slate-500 text-xs">
                                        {curso.total_lecciones - curso.lecciones_completadas}{" "}
                                        restantes
                                    </Text>
                                </View>
                            </View>
                        </Card>
                    ))
                )}
                <View className="h-6" />
            </ScrollView>
        </View>
    );
}
