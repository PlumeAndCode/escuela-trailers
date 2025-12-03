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
import { usePagosStore } from "../../src/stores/pagosStore";
import { Card } from "../../src/components/ui/Card";
import { Badge } from "../../src/components/ui/Badge";
import { Button } from "../../src/components/ui/Button";
import { Loading } from "../../src/components/ui/Loading";
import { Colors } from "../../src/constants/colors";
import type { EstadoPago, TipoPago, PagoResumen } from "../../src/types";

const estadosFiltro: (EstadoPago | null)[] = [null, "pendiente", "pagado", "vencido"];

const estadoLabels: Record<string, string> = {
    pendiente: "Pendiente",
    pagado: "Pagado",
    vencido: "Vencido",
};

const estadoVariants: Record<string, "warning" | "success" | "error"> = {
    pendiente: "warning",
    pagado: "success",
    vencido: "error",
};

const tiposPago: { value: TipoPago; label: string; icon: keyof typeof Ionicons.glyphMap }[] = [
    { value: "efectivo", label: "Efectivo", icon: "cash" },
    { value: "tarjeta", label: "Tarjeta", icon: "card" },
    { value: "linea", label: "En Línea", icon: "globe" },
];

export default function PagosScreen() {
    const {
        pagos,
        resumen,
        filtroEstado,
        isLoading,
        isPagando,
        fetchPagos,
        setFiltro,
        procesarPago,
    } = usePagosStore();
    const [modalVisible, setModalVisible] = useState(false);
    const [pagoSeleccionado, setPagoSeleccionado] = useState<PagoResumen | null>(null);
    const [tipoPagoSeleccionado, setTipoPagoSeleccionado] = useState<TipoPago>("efectivo");

    useEffect(() => {
        fetchPagos();
    }, []);

    const handlePagar = (pago: PagoResumen) => {
        setPagoSeleccionado(pago);
        setTipoPagoSeleccionado("efectivo");
        setModalVisible(true);
    };

    const confirmarPago = async () => {
        if (!pagoSeleccionado) return;

        const resultado = await procesarPago(pagoSeleccionado.id, tipoPagoSeleccionado);
        setModalVisible(false);
        setPagoSeleccionado(null);

        if (resultado) {
            Alert.alert(
                "¡Pago Realizado!",
                `Tu pago de ${resultado.monto_formateado} ha sido procesado exitosamente.${resultado.contratacion_activa ? "\n\n¡Tu servicio ya está activo!" : ""}`,
                [{ text: "OK" }]
            );
        } else {
            Alert.alert("Error", "No se pudo procesar el pago. Intenta de nuevo.");
        }
    };

    return (
        <View className="flex-1 bg-slate-100">
            {/* Header */}
            <View className="bg-slate-800 px-6 pt-14 pb-6">
                <Text className="text-2xl font-bold text-white">Pagos</Text>
                <Text className="text-slate-400 mt-1">Historial y próximos pagos</Text>
            </View>

            {/* Resumen */}
            {resumen && (
                <View className="px-4 -mt-4 mb-2">
                    <Card variant="elevated">
                        <View className="flex-row justify-between">
                            <View className="items-center flex-1">
                                <Text className="text-2xl font-bold text-green-600">
                                    {resumen.pagados}
                                </Text>
                                <Text className="text-slate-500 text-xs">Pagados</Text>
                            </View>
                            <View className="items-center flex-1">
                                <Text className="text-2xl font-bold text-amber-500">
                                    {resumen.pendientes}
                                </Text>
                                <Text className="text-slate-500 text-xs">Pendientes</Text>
                            </View>
                            <View className="items-center flex-1">
                                <Text className="text-2xl font-bold text-red-500">
                                    {resumen.vencidos}
                                </Text>
                                <Text className="text-slate-500 text-xs">Vencidos</Text>
                            </View>
                        </View>
                    </Card>
                </View>
            )}

            {/* Filtros */}
            <View className="flex-row flex-wrap px-4 py-3 gap-2">
                {estadosFiltro.map((estado) => (
                    <TouchableOpacity
                        key={estado || "all"}
                        onPress={() => setFiltro(estado)}
                        className={`px-4 py-2 rounded-full ${
                            filtroEstado === estado ? "bg-amber-500" : "bg-white"
                        }`}
                    >
                        <Text
                            className={`font-medium text-sm ${
                                filtroEstado === estado ? "text-white" : "text-slate-600"
                            }`}
                        >
                            {estado ? estadoLabels[estado] : "Todos"}
                        </Text>
                    </TouchableOpacity>
                ))}
            </View>

            {/* Lista de pagos */}
            <ScrollView
                className="flex-1 px-4"
                refreshControl={
                    <RefreshControl
                        refreshing={isLoading}
                        onRefresh={() => fetchPagos(filtroEstado || undefined)}
                    />
                }
            >
                {isLoading && (!pagos || pagos.length === 0) ? (
                    <Loading message="Cargando pagos..." />
                ) : !pagos || pagos.length === 0 ? (
                    <Card variant="outlined">
                        <View className="items-center py-8">
                            <Ionicons name="card-outline" size={48} color={Colors.secondary[400]} />
                            <Text className="text-slate-500 mt-4">No hay pagos registrados</Text>
                        </View>
                    </Card>
                ) : (
                    pagos.map((pago) => (
                        <Card key={pago.id} variant="elevated" className="mb-3">
                            <View className="flex-row items-center justify-between">
                                <View className="flex-row items-center flex-1">
                                    <View
                                        className={`w-10 h-10 rounded-full items-center justify-center ${
                                            pago.estado === "pagado"
                                                ? "bg-green-100"
                                                : pago.estado === "vencido"
                                                  ? "bg-red-100"
                                                  : "bg-amber-100"
                                        }`}
                                    >
                                        <Ionicons
                                            name={
                                                pago.estado === "pagado"
                                                    ? "checkmark-circle"
                                                    : pago.estado === "vencido"
                                                      ? "alert-circle"
                                                      : "time"
                                            }
                                            size={20}
                                            color={
                                                pago.estado === "pagado"
                                                    ? "#22c55e"
                                                    : pago.estado === "vencido"
                                                      ? "#ef4444"
                                                      : "#f59e0b"
                                            }
                                        />
                                    </View>
                                    <View className="ml-3 flex-1">
                                        <Text
                                            className="font-semibold text-slate-800"
                                            numberOfLines={1}
                                        >
                                            {pago.servicio}
                                        </Text>
                                        <Text className="text-slate-500 text-sm">
                                            {pago.fecha_pago}
                                        </Text>
                                    </View>
                                </View>
                                <View className="items-end">
                                    <Text className="font-bold text-slate-800">
                                        {pago.monto_formateado}
                                    </Text>
                                    {pago.estado === "pagado" ? (
                                        <Badge
                                            label={estadoLabels[pago.estado]}
                                            variant={estadoVariants[pago.estado]}
                                            size="sm"
                                        />
                                    ) : (
                                        <TouchableOpacity
                                            onPress={() => handlePagar(pago)}
                                            className="bg-green-500 px-3 py-1 rounded-full mt-1"
                                        >
                                            <Text className="text-white font-semibold text-xs">
                                                Pagar
                                            </Text>
                                        </TouchableOpacity>
                                    )}
                                </View>
                            </View>
                        </Card>
                    ))
                )}
                <View className="h-6" />
            </ScrollView>

            {/* Modal de pago */}
            <Modal
                visible={modalVisible}
                transparent
                animationType="fade"
                onRequestClose={() => setModalVisible(false)}
            >
                <View className="flex-1 bg-black/50 justify-center items-center px-6">
                    <View className="bg-white rounded-2xl w-full max-w-sm p-6">
                        <View className="items-center mb-4">
                            <View className="w-16 h-16 bg-green-100 rounded-full items-center justify-center mb-3">
                                <Ionicons name="wallet" size={32} color="#22c55e" />
                            </View>
                            <Text className="text-xl font-bold text-slate-800 text-center">
                                Realizar Pago
                            </Text>
                        </View>

                        {pagoSeleccionado && (
                            <View className="bg-slate-50 rounded-xl p-4 mb-4">
                                <Text className="font-semibold text-slate-800 text-center">
                                    {pagoSeleccionado.servicio}
                                </Text>
                                <Text className="text-green-600 font-bold text-xl text-center mt-2">
                                    {pagoSeleccionado.monto_formateado}
                                </Text>
                            </View>
                        )}

                        <Text className="text-slate-600 font-medium mb-3">Método de pago:</Text>
                        <View className="gap-2 mb-4">
                            {tiposPago.map((tipo) => (
                                <TouchableOpacity
                                    key={tipo.value}
                                    onPress={() => setTipoPagoSeleccionado(tipo.value)}
                                    className={`flex-row items-center p-3 rounded-xl border ${
                                        tipoPagoSeleccionado === tipo.value
                                            ? "border-green-500 bg-green-50"
                                            : "border-slate-200"
                                    }`}
                                >
                                    <Ionicons
                                        name={tipo.icon}
                                        size={24}
                                        color={
                                            tipoPagoSeleccionado === tipo.value
                                                ? "#22c55e"
                                                : "#64748b"
                                        }
                                    />
                                    <Text
                                        className={`ml-3 font-medium ${
                                            tipoPagoSeleccionado === tipo.value
                                                ? "text-green-600"
                                                : "text-slate-600"
                                        }`}
                                    >
                                        {tipo.label}
                                    </Text>
                                    {tipoPagoSeleccionado === tipo.value && (
                                        <View className="ml-auto">
                                            <Ionicons
                                                name="checkmark-circle"
                                                size={24}
                                                color="#22c55e"
                                            />
                                        </View>
                                    )}
                                </TouchableOpacity>
                            ))}
                        </View>

                        <View className="flex-row gap-3">
                            <View className="flex-1">
                                <Button
                                    title="Cancelar"
                                    variant="outline"
                                    onPress={() => {
                                        setModalVisible(false);
                                        setPagoSeleccionado(null);
                                    }}
                                />
                            </View>
                            <View className="flex-1">
                                <Button
                                    title="Confirmar"
                                    variant="success"
                                    onPress={confirmarPago}
                                    loading={isPagando}
                                />
                            </View>
                        </View>
                    </View>
                </View>
            </Modal>
        </View>
    );
}
