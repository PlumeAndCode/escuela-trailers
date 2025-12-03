import React, { useEffect } from "react";
import { View, Text, ScrollView, TouchableOpacity } from "react-native";
import { useLocalSearchParams, router } from "expo-router";
import { Ionicons } from "@expo/vector-icons";
import { useCursosStore } from "../../src/stores/cursosStore";
import { Card } from "../../src/components/ui/Card";
import { Badge } from "../../src/components/ui/Badge";
import { Loading } from "../../src/components/ui/Loading";
import { Colors, StatusColors } from "../../src/constants/colors";
import type { EstadoLeccion } from "../../src/types";

export default function CursoDetalleScreen() {
    const { id } = useLocalSearchParams<{ id: string }>();
    const { cursoActual, isLoading, fetchProgreso, clearCursoActual } = useCursosStore();

    useEffect(() => {
        if (id) {
            fetchProgreso(id);
        }
        return () => clearCursoActual();
    }, [id]);

    const getIconForEstado = (estado: EstadoLeccion): keyof typeof Ionicons.glyphMap => {
        switch (estado) {
            case "completada":
                return "checkmark-circle";
            case "en_progreso":
                return "play-circle";
            case "no_iniciada":
                return "ellipse-outline";
            case "bloqueada":
                return "lock-closed";
            default:
                return "ellipse-outline";
        }
    };

    const getColorForEstado = (estado: EstadoLeccion): string => {
        return StatusColors[estado] || Colors.secondary[400];
    };

    const getVariantForEstado = (
        estado: EstadoLeccion
    ): "success" | "info" | "default" | "warning" => {
        switch (estado) {
            case "completada":
                return "success";
            case "en_progreso":
                return "info";
            case "bloqueada":
                return "warning";
            default:
                return "default";
        }
    };

    if (isLoading || !cursoActual) {
        return <Loading fullScreen message="Cargando curso..." />;
    }

    const { curso, progreso, lecciones } = cursoActual;

    return (
        <View className="flex-1 bg-slate-100">
            {/* Header */}
            <View className="bg-slate-800 px-6 pt-14 pb-6">
                <TouchableOpacity
                    onPress={() => router.back()}
                    className="flex-row items-center mb-4"
                >
                    <Ionicons name="arrow-back" size={24} color="white" />
                    <Text className="text-white ml-2">Volver</Text>
                </TouchableOpacity>

                <Text className="text-2xl font-bold text-white">{curso.nombre}</Text>
                <Text className="text-slate-400 mt-2" numberOfLines={3}>
                    {curso.descripcion}
                </Text>
            </View>

            <ScrollView className="flex-1 px-4 -mt-4">
                {/* Progress Card */}
                <Card variant="elevated" className="mb-4">
                    <View className="flex-row items-center justify-between mb-3">
                        <Text className="text-lg font-bold text-slate-800">Tu Progreso</Text>
                        <Text className="text-2xl font-bold text-amber-500">
                            {progreso.porcentaje.toFixed(0)}%
                        </Text>
                    </View>

                    <View className="h-4 bg-slate-200 rounded-full overflow-hidden mb-3">
                        <View
                            className="h-full bg-amber-500 rounded-full"
                            style={{ width: `${progreso.porcentaje}%` }}
                        />
                    </View>

                    <View className="flex-row justify-between">
                        <View className="items-center">
                            <Text className="text-xl font-bold text-green-600">
                                {progreso.completadas}
                            </Text>
                            <Text className="text-slate-500 text-xs">Completadas</Text>
                        </View>
                        <View className="items-center">
                            <Text className="text-xl font-bold text-blue-500">
                                {lecciones.filter((l) => l.en_progreso).length}
                            </Text>
                            <Text className="text-slate-500 text-xs">En Progreso</Text>
                        </View>
                        <View className="items-center">
                            <Text className="text-xl font-bold text-slate-400">
                                {progreso.restantes}
                            </Text>
                            <Text className="text-slate-500 text-xs">Restantes</Text>
                        </View>
                    </View>
                </Card>

                {/* Lecciones */}
                <Text className="text-lg font-bold text-slate-800 mb-3">
                    Lecciones ({progreso.total_lecciones})
                </Text>

                {lecciones.map((leccion, index) => (
                    <Card
                        key={leccion.id}
                        variant={leccion.en_progreso ? "elevated" : "outlined"}
                        className={`mb-3 ${leccion.bloqueada ? "opacity-60" : ""}`}
                    >
                        <View className="flex-row items-start">
                            <View
                                className="w-10 h-10 rounded-full items-center justify-center"
                                style={{
                                    backgroundColor: `${getColorForEstado(leccion.estado)}20`,
                                }}
                            >
                                <Ionicons
                                    name={getIconForEstado(leccion.estado)}
                                    size={24}
                                    color={getColorForEstado(leccion.estado)}
                                />
                            </View>

                            <View className="flex-1 ml-3">
                                <View className="flex-row items-center justify-between">
                                    <Text className="text-slate-500 text-xs">
                                        Lección {leccion.numero}
                                    </Text>
                                    <Badge
                                        label={
                                            leccion.completada
                                                ? "Completada"
                                                : leccion.en_progreso
                                                  ? "En Progreso"
                                                  : leccion.bloqueada
                                                    ? "Bloqueada"
                                                    : "Pendiente"
                                        }
                                        variant={getVariantForEstado(leccion.estado)}
                                        size="sm"
                                    />
                                </View>
                                <Text className="font-semibold text-slate-800 mt-1">
                                    {leccion.titulo}
                                </Text>
                                <Text className="text-slate-500 text-sm mt-1" numberOfLines={2}>
                                    {leccion.descripcion}
                                </Text>
                                <View className="flex-row items-center mt-2">
                                    <Ionicons
                                        name="time-outline"
                                        size={14}
                                        color={Colors.secondary[400]}
                                    />
                                    <Text className="text-slate-400 text-xs ml-1">
                                        {leccion.duracion_minutos} minutos
                                    </Text>
                                </View>
                            </View>
                        </View>
                    </Card>
                ))}

                <View className="h-6" />
            </ScrollView>
        </View>
    );
}
