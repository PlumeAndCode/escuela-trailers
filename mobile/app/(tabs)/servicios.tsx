import React, { useEffect, useState } from "react";
import {
    View,
    Text,
    ScrollView,
    RefreshControl,
    TouchableOpacity,
    Modal,
    Alert,
} from "react-native";
import { Ionicons } from "@expo/vector-icons";
import { useServiciosStore } from "../../src/stores/serviciosStore";
import { Card } from "../../src/components/ui/Card";
import { Badge } from "../../src/components/ui/Badge";
import { Button } from "../../src/components/ui/Button";
import { Loading } from "../../src/components/ui/Loading";
import { Colors } from "../../src/constants/colors";
import { TipoServicioLabels } from "../../src/constants/colors";
import type { TipoServicio, Servicio } from "../../src/types";

const tiposServicio: (TipoServicio | null)[] = [
    null,
    "curso",
    "leccion",
    "licencia",
    "renta_trailer",
];

export default function ServiciosScreen() {
    const {
        servicios,
        filtroTipo,
        isLoading,
        isContratando,
        fetchServicios,
        setFiltro,
        contratarServicio,
        clearError,
    } = useServiciosStore();
    const [modalVisible, setModalVisible] = useState(false);
    const [servicioSeleccionado, setServicioSeleccionado] = useState<Servicio | null>(null);

    const handleContratar = (servicio: Servicio) => {
        setServicioSeleccionado(servicio);
        setModalVisible(true);
    };

    const confirmarContratacion = async () => {
        if (!servicioSeleccionado) return;

        const resultado = await contratarServicio(servicioSeleccionado.id);
        setModalVisible(false);
        setServicioSeleccionado(null);

        if (resultado) {
            Alert.alert(
                "¡Servicio Contratado!",
                `Has contratado "${resultado.servicio.nombre}" exitosamente.\n\nMonto a pagar: ${resultado.pago.monto_formateado}\nFecha límite: ${resultado.pago.fecha_limite}`,
                [{ text: "OK" }]
            );
        } else {
            Alert.alert("Error", "No se pudo contratar el servicio. Intenta de nuevo.");
        }
    };

    useEffect(() => {
        fetchServicios();
    }, []);

    const getIconForTipo = (tipo: TipoServicio) => {
        const icons: Record<TipoServicio, keyof typeof Ionicons.glyphMap> = {
            curso: "school",
            leccion: "book",
            licencia: "card",
            renta_trailer: "car",
        };
        return icons[tipo] || "briefcase";
    };

    return (
        <View className="flex-1 bg-slate-100">
            {/* Header */}
            <View className="bg-slate-800 px-6 pt-14 pb-6">
                <Text className="text-2xl font-bold text-white">Servicios</Text>
                <Text className="text-slate-400 mt-1">Explora nuestros servicios disponibles</Text>
            </View>

            {/* Filtros */}
            <View className="flex-row flex-wrap px-4 py-3 bg-white gap-2">
                {tiposServicio.map((tipo) => (
                    <TouchableOpacity
                        key={tipo || "all"}
                        onPress={() => setFiltro(tipo)}
                        className={`px-4 py-2 rounded-full ${
                            filtroTipo === tipo ? "bg-amber-500" : "bg-slate-100"
                        }`}
                    >
                        <Text
                            className={`font-medium text-sm ${
                                filtroTipo === tipo ? "text-white" : "text-slate-600"
                            }`}
                        >
                            {tipo ? TipoServicioLabels[tipo] : "Todos"}
                        </Text>
                    </TouchableOpacity>
                ))}
            </View>

            {/* Lista de servicios */}
            <ScrollView
                className="flex-1 px-4 pt-4"
                refreshControl={
                    <RefreshControl
                        refreshing={isLoading}
                        onRefresh={() => fetchServicios(filtroTipo || undefined)}
                    />
                }
            >
                {isLoading && servicios.length === 0 ? (
                    <Loading message="Cargando servicios..." />
                ) : servicios.length === 0 ? (
                    <Card variant="outlined">
                        <View className="items-center py-8">
                            <Ionicons
                                name="briefcase-outline"
                                size={48}
                                color={Colors.secondary[400]}
                            />
                            <Text className="text-slate-500 mt-4">
                                No hay servicios disponibles
                            </Text>
                        </View>
                    </Card>
                ) : (
                    servicios.map((servicio) => (
                        <Card key={servicio.id} variant="elevated" className="mb-3">
                            <View className="flex-row items-start">
                                <View className="w-12 h-12 bg-amber-100 rounded-xl items-center justify-center">
                                    <Ionicons
                                        name={getIconForTipo(servicio.tipo)}
                                        size={24}
                                        color={Colors.primary[500]}
                                    />
                                </View>
                                <View className="flex-1 ml-3">
                                    <View className="flex-row items-center justify-between">
                                        <Text
                                            className="font-bold text-slate-800 flex-1"
                                            numberOfLines={1}
                                        >
                                            {servicio.nombre}
                                        </Text>
                                        <Badge
                                            label={TipoServicioLabels[servicio.tipo]}
                                            variant="info"
                                            size="sm"
                                        />
                                    </View>
                                    <Text className="text-slate-500 text-sm mt-1" numberOfLines={2}>
                                        {servicio.descripcion}
                                    </Text>
                                    <View className="flex-row items-center justify-between mt-2">
                                        <Text className="text-amber-600 font-bold">
                                            {servicio.precio_formateado}
                                        </Text>
                                        <TouchableOpacity
                                            onPress={() => handleContratar(servicio)}
                                            className="bg-amber-500 px-4 py-2 rounded-lg"
                                        >
                                            <Text className="text-white font-semibold text-sm">
                                                Contratar
                                            </Text>
                                        </TouchableOpacity>
                                    </View>
                                </View>
                            </View>
                        </Card>
                    ))
                )}
                <View className="h-6" />
            </ScrollView>

            {/* Modal de confirmación */}
            <Modal
                visible={modalVisible}
                transparent
                animationType="fade"
                onRequestClose={() => setModalVisible(false)}
            >
                <View className="flex-1 bg-black/50 justify-center items-center px-6">
                    <View className="bg-white rounded-2xl w-full max-w-sm p-6">
                        <View className="items-center mb-4">
                            <View className="w-16 h-16 bg-amber-100 rounded-full items-center justify-center mb-3">
                                <Ionicons name="cart" size={32} color={Colors.primary[500]} />
                            </View>
                            <Text className="text-xl font-bold text-slate-800 text-center">
                                Confirmar Contratación
                            </Text>
                        </View>

                        {servicioSeleccionado && (
                            <View className="bg-slate-50 rounded-xl p-4 mb-4">
                                <Text className="font-semibold text-slate-800 text-center">
                                    {servicioSeleccionado.nombre}
                                </Text>
                                <Text className="text-slate-500 text-sm text-center mt-1">
                                    {TipoServicioLabels[servicioSeleccionado.tipo]}
                                </Text>
                                <Text className="text-amber-600 font-bold text-xl text-center mt-2">
                                    {servicioSeleccionado.precio_formateado}
                                </Text>
                            </View>
                        )}

                        <Text className="text-slate-500 text-center text-sm mb-4">
                            Se generará un pago pendiente con fecha límite de 7 días.
                        </Text>

                        <View className="flex-row gap-3">
                            <View className="flex-1">
                                <Button
                                    title="Cancelar"
                                    variant="outline"
                                    onPress={() => {
                                        setModalVisible(false);
                                        setServicioSeleccionado(null);
                                    }}
                                />
                            </View>
                            <View className="flex-1">
                                <Button
                                    title="Contratar"
                                    onPress={confirmarContratacion}
                                    loading={isContratando}
                                />
                            </View>
                        </View>
                    </View>
                </View>
            </Modal>
        </View>
    );
}
