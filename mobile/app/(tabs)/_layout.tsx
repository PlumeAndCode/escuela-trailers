import React from "react";
import { Tabs } from "expo-router";
import { Ionicons } from "@expo/vector-icons";
import { Platform } from "react-native";
import { Colors } from "../../src/constants/colors";

export default function TabsLayout() {
    return (
        <Tabs
            screenOptions={{
                headerShown: false,
                tabBarActiveTintColor: Colors.primary[500],
                tabBarInactiveTintColor: Colors.secondary[400],
                tabBarStyle: {
                    backgroundColor: Colors.white,
                    borderTopWidth: 0,
                    elevation: 10,
                    shadowColor: "#000",
                    shadowOffset: { width: 0, height: -2 },
                    shadowOpacity: 0.1,
                    shadowRadius: 8,
                    height: Platform.OS === "ios" ? 90 : 70,
                    paddingBottom: Platform.OS === "ios" ? 30 : 10,
                    paddingTop: 10,
                },
                tabBarLabelStyle: {
                    fontSize: 11,
                    fontWeight: "600",
                },
            }}
        >
            <Tabs.Screen
                name="index"
                options={{
                    title: "Inicio",
                    tabBarIcon: ({ color, size }) => (
                        <Ionicons name="home" size={size} color={color} />
                    ),
                }}
            />
            <Tabs.Screen
                name="servicios"
                options={{
                    title: "Servicios",
                    tabBarIcon: ({ color, size }) => (
                        <Ionicons name="briefcase" size={size} color={color} />
                    ),
                }}
            />
            <Tabs.Screen
                name="pagos"
                options={{
                    title: "Pagos",
                    tabBarIcon: ({ color, size }) => (
                        <Ionicons name="card" size={size} color={color} />
                    ),
                }}
            />
            <Tabs.Screen
                name="cursos"
                options={{
                    title: "Cursos",
                    tabBarIcon: ({ color, size }) => (
                        <Ionicons name="school" size={size} color={color} />
                    ),
                }}
            />
            <Tabs.Screen
                name="perfil"
                options={{
                    title: "Perfil",
                    tabBarIcon: ({ color, size }) => (
                        <Ionicons name="person" size={size} color={color} />
                    ),
                }}
            />
        </Tabs>
    );
}
